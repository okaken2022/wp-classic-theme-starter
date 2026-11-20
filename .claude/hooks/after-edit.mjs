#!/usr/bin/env node
/**
 * PostToolUse hook: 編集したファイルに応じてビルド・lint を走らせる
 *
 * - *.scss → sass ビルド + stylelint（編集したファイルのみ）
 * - *.php  → php -l（php が無ければスキップ）
 *
 * 失敗したら exit 2 で stderr を Claude に返し、その場で修正させる。
 */
import { spawnSync } from "node:child_process";
import { relative } from "node:path";

const projectDir = process.env.CLAUDE_PROJECT_DIR || process.cwd();

let input = "";
for await (const chunk of process.stdin) input += chunk;

let filePath = "";
try {
  const payload = JSON.parse(input || "{}");
  filePath = payload?.tool_input?.file_path || "";
} catch {
  process.exit(0);
}
if (!filePath) process.exit(0);

const rel = relative(projectDir, filePath);
if (rel.startsWith("..") || rel.startsWith("node_modules")) process.exit(0);

const run = (cmd, args) =>
  spawnSync(cmd, args, { cwd: projectDir, encoding: "utf8", shell: process.platform === "win32" });

const fail = (title, result) => {
  const output = `${result.stdout || ""}${result.stderr || ""}`.trim();
  process.stderr.write(`[after-edit] ${title} に失敗しました: ${rel}\n${output}\n`);
  process.exit(2);
};

if (rel.endsWith(".scss")) {
  const build = run("npm", ["run", "--silent", "build:css"]);
  if (build.status !== 0) fail("Sass のビルド", build);

  const lint = run("npx", ["--no-install", "stylelint", rel]);
  if (lint.status !== 0) fail("stylelint", lint);
}

if (rel.endsWith(".php")) {
  const which = run("php", ["-v"]);
  if (which.status === 0) {
    const lint = run("php", ["-l", rel]);
    if (lint.status !== 0) fail("php -l", lint);
  }
}

process.exit(0);
