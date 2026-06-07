<?php
/*
* 404 Not Found
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">404</span>
        <span class="sub-mv__title-ja">ページが見つかりません</span>
      </h1>
    </div>
  </section>

  <section class="not-found">
    <div class="not-found__inner">
      <h2 class="not-found__title">お探しのページは見つかりませんでした。</h2>
      <p class="not-found__text">アクセスいただいたページは、移動または削除された可能性があります。<br class="u-desktop-inline">お手数ですが、URLに誤りがないか今一度ご確認ください。</p>
      <div class="not-found__btn">
        <a href="<?php echo HOME_URL; ?>" class="button">
          <span class="button__label">TOPへ戻る</span>
          <span class="button__arrow" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
