# テンプレート・PHP

## ファイル

| 種別 | 命名 | 備考 |
|---|---|---|
| トップ | `front-page.php` | |
| 固定ページ | `page-{slug}.php` | スラッグと一致させる |
| 固定ページ（共通） | `page.php` | 個別テンプレートが無いページ |
| 投稿一覧など | `index.php` | |
| CPT | `archive-{type}.php` / `single-{type}.php` | 登録は `inc/post-types.php` |
| 共通パーツ | `template-parts/{name}.php` | `$args` で値を渡す |

`functions.php` は `inc/` を読み込むだけにする。

## 用意済みのパーツ

```php
get_template_part('template-parts/page-head', null, array('title' => '会社概要', 'en' => 'Company'));
get_template_part('template-parts/section-title', null, array('en' => 'Message', 'ja' => '代表挨拶'));
get_template_part('template-parts/page-nav', null, array('items' => array(
    array('label' => '会社概要', 'id' => 'outline'),
)));
```

## ヘルパー（`inc/helpers.php`）

| 関数 | 用途 |
|---|---|
| `starter_theme_img('top/kv.webp')` | テーマ内画像の URL（エスケープ済み） |
| `starter_theme_page_url('company')` | 固定ページの URL（無ければ `/company/`） |
| `starter_theme_is_current('company')` | ナビの現在地判定 |

## グローバルナビ

`inc/setup.php` の `starter_theme_nav_items()` が唯一の定義元。header と footer はここから生成する。

## ヘッダーの配色切り替え

```php
get_header('', array('theme' => 'light')); // .header--light
```

## セキュリティ

- 出力は `esc_html` / `esc_attr` / `esc_url`
- 外部リンクの `target="_blank"` には `rel="noopener noreferrer"`
- フォームは Contact Form 7 などのプラグインに任せ、自作する場合は nonce を必ず使う
