---
name: init-theme
description: このスターターから新規案件のテーマを立ち上げる（テーマ名・プレフィックスの一括置換、配色トークン、Local の URL、デプロイ設定）。テンプレートから作った直後に一度だけ使う。
disable-model-invocation: true
---

# 新規案件の初期化

## 1. ユーザーに聞く（まとめて 1 回で）

- サイト名（例: 株式会社サンプル）
- テーマのスラッグ（英小文字とアンダースコア。例: `sample_corp`）。テーマフォルダ名と関数プレフィックスになる
- Local のサイト URL（例: `http://sample-corp.local`）
- メインカラー・アクセントカラー（分からなければ後回しでよい）

## 2. 置換スクリプトを実行

```bash
node scripts/init-theme.mjs --name "<サイト名>" --slug <slug>
```

`starter_theme` / `starter-theme` / `STARTER_THEME` / `Starter Theme` がまとめて置き換わる。実行後に `grep -rn "starter" --exclude-dir=node_modules .` で取り残しがないか確認する。

## 3. 個別に設定する

- `.claude/launch.json` の `url` を Local のサイト URL にする
- `sass/abstracts/_variables.scss` の `$color-primary` / `$color-accent` などを更新する
- `inc/setup.php` の `starter_theme_nav_items()`（置換後のプレフィックス）をサイトマップに合わせる
- `inc/enqueue.php` の Google Fonts をデザインのフォントに合わせ、`$font-family-*` も揃える

## 4. ビルドして確認

```bash
npm ci
npm run build
npm run lint
```

## 5. ユーザーに残りの作業を伝える

- Local の `wp-content/themes/<slug>/` にこのリポジトリを置き、管理画面でテーマを有効化する
- GitHub の Settings > Secrets and variables > Actions に、`docs/DEPLOY.md` の Secrets を登録する
- Settings > Environments > production に Required reviewers を設定する（本番の誤デプロイ防止）
