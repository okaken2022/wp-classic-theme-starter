# デプロイ

`.github/workflows/deploy.yml`

| きっかけ | 動き |
|---|---|
| Pull Request | ビルドと lint のみ |
| `main` への push | ビルド・lint → **Staging** に FTP デプロイ |
| Actions 画面の Run workflow で `production` を選ぶ | ビルド・lint → **Production** に FTP デプロイ |

lint かビルドが失敗したらデプロイしない。

## Secrets

Settings > Secrets and variables > Actions に登録する。

| 名前 | 例 |
|---|---|
| `FTP_SERVER_STAGING` | `sv0000.xserver.jp` |
| `FTP_USERNAME_STAGING` | |
| `FTP_PASSWORD_STAGING` | |
| `FTP_SERVER_DIR_STAGING` | `/example.com/public_html/test.example.com/wp-content/themes/my_theme/` |
| `FTP_SERVER_PRODUCTION` | |
| `FTP_USERNAME_PRODUCTION` | |
| `FTP_PASSWORD_PRODUCTION` | |
| `FTP_SERVER_DIR_PRODUCTION` | `/example.com/public_html/wp-content/themes/my_theme/` |

`*_SERVER_DIR_*` の末尾の `/` は自動で補う。

## Environments

Settings > Environments に `staging` と `production` を作る。`production` に **Required reviewers** を付けると、本番デプロイの前に承認が必要になる。

## サーバーに上げないもの

`sass/`、`docs/`、`scripts/`、`.claude/`、`.github/`、`_private/`、`*.md`、`*.pdf`、`*.map`、`package*.json` など。一覧は workflow の `exclude` にある。

公開しない資料を追加するときは `_private/` に置く。新しい種類のファイルを除外したいときは `exclude` に追記する。

## 初回デプロイの注意

FTP-Deploy-Action は、サーバー上の `.ftp-deploy-sync-state.json` を見て差分だけを送る。初回はすべてのファイルを送るため時間がかかる。既存のテーマに上書きする場合は、先にサーバー側のバックアップを取る。
