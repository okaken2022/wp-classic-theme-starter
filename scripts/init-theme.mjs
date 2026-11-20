#!/usr/bin/env node
/**
 * スターターの仮名（starter_theme 等）を案件用の名前に一括置換する
 *
 *   node scripts/init-theme.mjs --name "株式会社サンプル" --slug sample_corp
 *
 *   starter_theme  → sample_corp   （関数プレフィックス）
 *   STARTER_THEME  → SAMPLE_CORP   （定数）
 *   starter-theme  → sample-corp   （ハンドル名・Text Domain・package name）
 *   Starter Theme  → 株式会社サンプル（Theme Name）
 */
import { readdirSync, readFileSync, statSync, writeFileSync } from "node:fs";
import { join } from "node:path";
import { parseArgs } from "node:util";

const { values } = parseArgs({
  options: {
    name: { type: "string" },
    slug: { type: "string" },
    "dry-run": { type: "boolean", default: false },
  },
});

if (!values.name || !values.slug) {
  console.error('使い方: node scripts/init-theme.mjs --name "サイト名" --slug my_theme [--dry-run]');
  process.exit(1);
}
if (!/^[a-z][a-z0-9_]*$/.test(values.slug)) {
  console.error("--slug は英小文字・数字・アンダースコアで、英字から始めてください（例: sample_corp）");
  process.exit(1);
}

const slug = values.slug;
const replacements = [
  ["STARTER_THEME", slug.toUpperCase()],
  ["starter_theme", slug],
  ["starter-theme", slug.replace(/_/g, "-")],
  ["Starter Theme", values.name],
];

const IGNORE = new Set(["node_modules", ".git", "css", "img", "init-theme.mjs", "package-lock.json"]);
const EXTENSIONS = /\.(php|scss|js|mjs|json|md|css|yml)$/;

function walk(dir, out = []) {
  for (const name of readdirSync(dir)) {
    if (IGNORE.has(name)) continue;
    const path = join(dir, name);
    if (statSync(path).isDirectory()) walk(path, out);
    else if (EXTENSIONS.test(name)) out.push(path);
  }
  return out;
}

let changed = 0;
for (const file of walk(".")) {
  const before = readFileSync(file, "utf8");
  let after = before;
  for (const [from, to] of replacements) after = after.split(from).join(to);
  if (after !== before) {
    changed++;
    console.log(`${values["dry-run"] ? "[dry-run] " : ""}更新: ${file}`);
    if (!values["dry-run"]) writeFileSync(file, after);
  }
}

console.log(`\n${changed} ファイルを${values["dry-run"] ? "置換予定" : "置換しました"}。`);
if (!values["dry-run"]) {
  console.log("package-lock.json を更新するため npm install を実行してください。");
}
