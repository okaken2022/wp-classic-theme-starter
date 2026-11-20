# wp-classic-theme-starter

Claude Code で作業しやすいように整えた、コーポレートサイト向けクラシック WordPress テーマのスターター。

- PHP テンプレート中心（Gutenberg 無効）
- Dart Sass（`@use` / `@forward`）+ BEM + デザイントークン
- GSAP（ScrollTrigger）/ Splide
- GitHub Actions：ビルド・lint を通してから FTP デプロイ（Staging は自動、Production は手動）
- Claude Code 向け：`CLAUDE.md`、パス別ルール、スキル（`/new-page` など）、編集後に自動でビルド・lint する hooks

## はじめかた

1. GitHub で **Use this template** から案件用のリポジトリを作る
2. Local のサイトの `wp-content/themes/` に clone する

   ```bash
   cd "~/Local Sites/<site>/app/public/wp-content/themes"
   git clone git@github.com:<owner>/<repo>.git <theme_slug>
   cd <theme_slug>
   npm ci
   ```

3. Claude Code でフォルダを開き、`/init-theme` を実行する（テーマ名の置換・配色・Local の URL を設定）
4. `npm run build` を実行し、管理画面でテーマを有効化する

詳しくは [docs/SETUP.md](docs/SETUP.md)。

## コマンド

| コマンド | 内容 |
|---|---|
| `npm run build` | `sass/style.scss` → `css/style.css` |
| `npm run watch` | 監視ビルド |
| `npm run lint` | stylelint + `php -l` |
| `node scripts/init-theme.mjs --name "サイト名" --slug my_theme` | テーマ名・プレフィックスの一括置換 |

## Claude Code スキル

| コマンド | 内容 |
|---|---|
| `/new-page <slug> <ページ名>` | 固定ページ一式（PHP・Sass・画像フォルダ）を作成 |
| `/figma-to-section <Figma URL>` | Figma のフレームを規約どおりに実装 |
| `/init-theme` | 新規案件の初期化 |

## ドキュメント

[docs/README.md](docs/README.md) を参照。
