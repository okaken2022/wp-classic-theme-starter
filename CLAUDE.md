# CLAUDE.md

コーポレートサイト用の **クラシック WordPress テーマ**（Gutenberg 無効・PHP テンプレート中心）。
リポジトリのルート = テーマフォルダ（`wp-content/themes/<slug>/` にそのまま置く）。

## コマンド

```bash
npm run build      # sass/style.scss → css/style.css（圧縮 + ソースマップ）
npm run watch      # 開発中の監視ビルド
npm run lint       # stylelint（BEM・& 連結禁止などを機械チェック）+ php -l
```

`.scss` / `.php` を編集すると hooks（`.claude/hooks/after-edit.mjs`）がビルドと lint を自動で実行する。
エラーが返ってきたら、その場で直してから次の作業に進む。

## ディレクトリ

```
functions.php            読み込みだけ。処理は inc/ に書く
inc/setup.php            テーマサポート・グローバルナビ定義 starter_theme_nav_items()
inc/enqueue.php          CSS/JS 読み込み（外部ライブラリのバージョン固定もここ）
inc/helpers.php          starter_theme_img() / starter_theme_page_url() など
inc/post-types.php       カスタム投稿タイプ
page-{slug}.php          固定ページ（スラッグと一致させる）
template-parts/          共通パーツ（$args で値を渡す）
sass/                    abstracts → base → layout → components → pages → utility
css/style.css            ビルド成果物（git 管理外。直接編集しない）
js/main.js               initXxx() 単位で機能を追加
img/{page}/              ページ別の画像
docs/                    人向けの詳細ドキュメント
```

## 絶対ルール

- **既存のトークンを使う**: 色・フォントサイズ・余白の基準・z-index は `sass/abstracts/_variables.scss` から使う。無ければ**用途名**で追加してから使う（`$color-blue2` のような見た目名・連番は禁止）。
- **BEM**: `.block__element--modifier`。block / element はキャメルケース（`.pageHead__title`）。`&__` `&--` で連結しない（stylelint が落とす）。`&:hover` `&::before` `&.is-xxx` はOK。
- **プレフィックス**: レイアウトは `.l-*`、ユーティリティは `.u-*`、JS で付ける状態は `.is-*`。
- **SP ファースト**: 基本スタイルは SP、`@include mq(md)` などで広げる。`mq-down()` は例外のときだけ。
- **PHP の出力は必ずエスケープ**: `esc_html` / `esc_attr` / `esc_url`。テーマ内画像は `starter_theme_img('top/kv.webp')`。
- **関数・フック名**は `starter_theme_` で始める。
- **アニメーション**: `fade-in-up|down|left|right`（`data-gsap-delay` で遅延）、`crop-from-*`。新しい動きは `js/main.js` と `sass/components/_fadein.scss` をセットで追加する。
- **依頼に関係ないファイルは触らない。** `css/style.css` は手で編集しない。

## よく使う作業

- 新しい固定ページ: `/new-page <slug> <ページ名>`
- Figma からセクション実装: `/figma-to-section <Figma URL>`
- 新規案件の初期化: `/init-theme`

## 実装後の確認

1. hooks のビルド・lint が通っていること
2. `.claude/launch.json` の Local サイトをブラウザで開き、**375px と 1280px** で表示を確認する
3. コンソールに JS エラーが出ていないこと

## 詳細

規約の理由や例は `docs/` にある（`docs/README.md` が索引）。ファイル種別ごとの要点は `.claude/rules/` が該当ファイル編集時に読み込まれる。
