---
name: new-page
description: WordPress の固定ページを新規作成する（page-{slug}.php・Sass パーシャル・画像フォルダ・ナビ追加をまとめて行う）。「〇〇ページを作って」「新規ページ」などの依頼で使う。
argument-hint: <slug> <ページ名> [英語見出し]
---

# 新規固定ページ作成

引数: `$ARGUMENTS`（例: `company 会社概要 Company`）。slug やページ名が無ければユーザーに聞く。

## 手順

1. **名前を決める**
   - ファイル: `page-{slug}.php`（slug はケバブケース可: `mid-career`）
   - ブロック名・Sass ファイル名: slug をキャメルケースにする（`mid-career` → `midCareer`）
   - 既に同名のファイルがあれば作らずに報告する

2. **テンプレートを作る** `page-{slug}.php`

   ```php
   <?php
   /**
    * {ページ名}
    */
   get_header();
   ?>

   <main class="{block}">
     <?php get_template_part('template-parts/page-head', null, array('title' => '{ページ名}', 'en' => '{英語見出し}')); ?>

     <section class="{block}Intro l-section" id="intro">
       <div class="l-wrapper">
         <?php get_template_part('template-parts/section-title', null, array('en' => 'Intro', 'ja' => '導入')); ?>
       </div>
     </section>
   </main>

   <?php get_footer(); ?>
   ```

   デザインやセクション構成が分かっていれば、ここでセクションを並べる。セクションのブロック名は `{block}{Section}`（例: `companyMessage`）。

3. **Sass を作る** `sass/pages/_{block}.scss`

   ```scss
   @use "../abstracts" as *;

   // page-{slug}.php
   .{block}Intro {
   }
   ```

   空ルールは lint で落ちるので、中身が決まるまではコメントだけにしておく。
   `sass/style.scss` の `// Pages` グループ末尾に `@use "pages/{block}";` を追加する。

4. **画像フォルダ** `img/{slug}/` を作り、空なら `.gitkeep` を置く。

5. **ナビ**（ユーザーがナビに載せると言った場合のみ）: `inc/setup.php` の `starter_theme_nav_items()` に追加する。

6. **確認**
   - hooks のビルド・lint が通っていること（通らなければ直す）
   - ユーザーに次の作業を伝える:
     - 管理画面 > 固定ページ > 新規追加 で、スラッグ `{slug}` のページを作成する
     - ページが表示されたら、ブラウザで 375px / 1280px を確認する（Local の URL が分かればこちらで確認する）

## 出力

作ったファイルの一覧と、管理画面で必要な作業だけを短く報告する。
