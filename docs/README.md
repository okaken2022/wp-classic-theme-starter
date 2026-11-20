# ドキュメント索引

| ファイル | 内容 |
|---|---|
| [SETUP.md](./SETUP.md) | 新規案件の立ち上げ手順 |
| [SASS.md](./SASS.md) | Sass の構成・トークン・命名規則 |
| [PHP.md](./PHP.md) | テンプレート構成・PHP の規約 |
| [JS.md](./JS.md) | main.js・アニメーション・スライダー |
| [DEPLOY.md](./DEPLOY.md) | GitHub Actions による FTP デプロイ |

## AI 向けの設定（どこに何があるか）

| 場所 | 役割 | 読み込まれるタイミング |
|---|---|---|
| `CLAUDE.md` | 全体方針・コマンド・絶対ルール | 常に |
| `.claude/rules/sass.md` | Sass の要点 | `sass/**` を扱うとき |
| `.claude/rules/php.md` | PHP の要点 | `*.php` を扱うとき |
| `.claude/rules/js.md` | JS の要点 | `js/**` を扱うとき |
| `.claude/skills/*` | 定型作業の手順（`/new-page` など） | 呼び出したとき |
| `.claude/hooks/after-edit.mjs` | 編集後のビルド・lint | ファイル編集のたび |
| `.claude/settings.json` | 許可するコマンド・hooks の登録 | 常に |
| `.claude/launch.json` | ブラウザで確認する Local の URL | 表示確認のとき |

**情報を置く場所の決め方**

- 毎回守らせたい短いルール → `CLAUDE.md` か `.claude/rules/`
- 手順が決まっている作業 → `.claude/skills/`
- 理由・背景・長い例 → `docs/`
- 機械的に判定できるルール → stylelint / hooks（文章で書くより確実）

同じ内容を複数の場所に書かない。ルールを変えたら、該当する 1 か所だけを直す。

Cursor など他のツールでも使う場合は、`AGENTS.md` を作って `CLAUDE.md` へのシンボリックリンクにする。
