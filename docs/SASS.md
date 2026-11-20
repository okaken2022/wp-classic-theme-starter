# Sass

## 構成

```
sass/
├── style.scss        エントリーポイント（@use の並び = 読み込み順）
├── abstracts/        変数・関数・mixin（CSS は出力しない）
│   ├── _index.scss   variables → functions → mixins の順に @forward
│   ├── _variables.scss
│   ├── _functions.scss
│   └── _mixins.scss
├── base/             reset・要素の初期スタイル
├── layout/           header / footer / .l-wrapper / .l-section
├── components/       複数ページで使う部品
├── pages/            ページ固有（ファイル名 = ブロック名）
└── utility/          .u-*（最後に読み込む）
```

出力先は `css/style.css`（git 管理外。CI でビルドしてデプロイする）。

## デザイントークン

`_variables.scss` に集約する。**色は用途で名前を付ける**。

| よい例 | 避ける例 | 理由 |
|---|---|---|
| `$color-primary` | `$color-navy` | 色を変えたとき名前と合わなくなる |
| `$color-bg-subtle` | `$color-lightGray2` | 連番では使い分けが分からない |
| `$color-bg-recruit` | `$color-accordion1` | 部品名ではなく用途で |

新しい値が必要になったら、まずトークンを追加してから使う。パーシャルに `#xxx` を直書きしない。

## mixin / function

| 名前 | 用途 |
|---|---|
| `mq($key)` | min-width。`xs 530 / sm 670 / md 768 / lg 1024 / xl 1180 / xxl 1280` |
| `mq-down($key)` | max-width（例外用） |
| `hover` | タッチ端末で hover が残らない `:hover` |
| `hover-opacity($opacity: 0.7)` | |
| `line-height($type)` | `narrow / tight / base / relaxed` |
| `visually-hidden` | |
| `rem($px)` | `rem(18)` → `1.125rem` |
| `to-vw($px, $base)` | `to-vw(60, 1440)` |
| `z($key)` | `$z-index` マップから取得 |

未定義のキーを渡すと `@error` でビルドが止まる（気づかないまま壊れるのを防ぐ）。

## 命名

- BEM: `.block__element--modifier`、block / element / modifier はキャメルケース
- `.l-*` レイアウト、`.u-*` ユーティリティ、`.is-*` JS で付ける状態
- 修飾子を `&--` で連結しない。検索で `.card__title--large` が見つかるようにするため（stylelint `scss/selector-no-union-class-name` で検査）
- `&:hover`、`&::before`、`&.is-open` はよい

## ページを追加するとき

`/new-page` を使うか、次の手順で追加する。

1. `sass/pages/_{block}.scss` を作る
2. `style.scss` の `// Pages` グループ末尾に `@use "pages/{block}";` を追加する
