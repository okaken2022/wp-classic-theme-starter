# 新規案件の立ち上げ

## 1. リポジトリを作る

GitHub でこのリポジトリの **Use this template** → 案件用のリポジトリを作成（private 推奨）。

## 2. Local に置く

```bash
cd "~/Local Sites/<site>/app/public/wp-content/themes"
git clone git@github.com:<owner>/<repo>.git <theme_slug>
cd <theme_slug>
npm ci
```

フォルダ名（`<theme_slug>`）は、次の手順で決めるスラッグと揃える。

## 3. 初期化

Claude Code でテーマフォルダを開き、`/init-theme` を実行する。手動で行う場合は次のとおり。

```bash
node scripts/init-theme.mjs --name "株式会社サンプル" --slug sample_corp
npm install   # package-lock.json の name を更新
```

続けて次を設定する。

- `.claude/launch.json` の `url` を Local のサイト URL にする
- `sass/abstracts/_variables.scss` の配色・フォント
- `inc/enqueue.php` の Google Fonts
- `inc/setup.php` のグローバルナビ

## 4. ビルドして有効化

```bash
npm run build
```

管理画面 > 外観 > テーマ で有効化する。

## 5. WordPress の設定

- [ ] 設定 > パーマリンク を「投稿名」にする
- [ ] 設定 > 表示設定 でホームページを固定ページにする場合は、`front-page.php` が使われることを確認する
- [ ] 固定ページを作り、スラッグを `page-{slug}.php` と一致させる

## 6. デプロイ設定

[DEPLOY.md](./DEPLOY.md) の Secrets を登録する。

## 7. 公開しない資料

仕様書・サイトマップ・カンプの PDF などは `_private/` に置く（git 管理外・デプロイ対象外）。テーマフォルダの直下に置くと、URL を知っている人なら誰でも開けてしまう。

## 動作確認チェックリスト

- [ ] トップページ・固定ページ・404 が表示される
- [ ] ハンバーガーメニューが開閉する（Esc でも閉じる）
- [ ] `fade-in-*` / `crop-from-*` が動く
- [ ] 375px / 768px / 1280px でレイアウトが崩れない
- [ ] コンソールに JS エラーがない
