#!/usr/bin/env node
// テーマ内の全 PHP に php -l をかける（php が無い環境ではスキップ）
import { spawnSync } from "node:child_process";
import { readdirSync, statSync } from "node:fs";
import { join } from "node:path";

const IGNORE = new Set(["node_modules", ".git", "css", "img"]);

function collect(dir, out = []) {
  for (const name of readdirSync(dir)) {
    if (IGNORE.has(name)) continue;
    const path = join(dir, name);
    if (statSync(path).isDirectory()) collect(path, out);
    else if (name.endsWith(".php")) out.push(path);
  }
  return out;
}

if (spawnSync("php", ["-v"]).status !== 0) {
  console.warn("php が見つからないため lint:php をスキップしました");
  process.exit(0);
}

let failed = 0;
for (const file of collect(".")) {
  const result = spawnSync("php", ["-l", file], { encoding: "utf8" });
  if (result.status !== 0) {
    failed++;
    process.stderr.write(result.stdout + result.stderr);
  }
}

if (failed) {
  console.error(`php -l: ${failed} 件のエラー`);
  process.exit(1);
}
console.log("php -l: OK");
