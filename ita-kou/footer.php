<footer class="footer">
  <div class="footer__inner">
    <div class="footer__main">
      <a href="<?php echo HOME_URL; ?>" class="footer__logo">
        <img src="<?php echo IMAGEPATH; ?>/common/logo.svg" alt="有限会社 板岡工作所" class="footer__logo-img"
          width="306" height="50">
      </a>

      <div class="footer__info">
        <p class="footer__name">有限会社 板岡工作所</p>
        <p class="footer__address">
          〒651-2114 兵庫県神戸市西区今寺36-11
          <a href="https://www.google.com/maps?q=兵庫県神戸市西区今寺36-11" class="footer__map" target="_blank"
            rel="noopener">Google Map</a>
        </p>
      </div>

      <span class="footer__divider" aria-hidden="true"></span>

      <nav class="footer__nav" aria-label="フッターナビゲーション">
        <ul class="footer__nav-items">
          <li class="footer__nav-item footer__nav-item--top">
            <a href="<?php echo HOME_URL; ?>" class="footer__nav-link">TOP<span class="footer__nav-arrow"></span></a>
          </li>
          <li class="footer__nav-item">
            <a href="<?php echo SERVICES_URL; ?>" class="footer__nav-link">業務内容<span class="footer__nav-arrow"></span></a>
          </li>
          <li class="footer__nav-item">
            <a href="<?php echo FACILITIES_URL; ?>" class="footer__nav-link">設備紹介<span class="footer__nav-arrow"></span></a>
          </li>
          <li class="footer__nav-item">
            <a href="<?php echo COMPANY_URL; ?>" class="footer__nav-link">会社情報<span class="footer__nav-arrow"></span></a>
          </li>
          <li class="footer__nav-item">
            <a href="<?php echo RECRUITMENT_URL; ?>" class="footer__nav-link">採用情報<span class="footer__nav-arrow"></span></a>
          </li>
        </ul>
      </nav>

      <div class="footer__contact">
        <a href="<?php echo CONTACT_URL; ?>" class="footer__contact-btn">お問い合わせフォーム<span
            class="footer__contact-arrow"><img src="<?php echo IMAGEPATH; ?>/common/btn-arrow-blue.svg" alt=""
              width="14" height="14"></span></a>
      </div>

      <a href="#top" class="footer__to-top js-to-top" aria-label="ページ上部へ戻る">
        <img src="<?php echo IMAGEPATH; ?>/common/to-top.svg" alt="" width="40" height="40">
      </a>
    </div>

    <div class="footer__bottom">
      <a href="<?php echo PRIVACY_POLICY_URL; ?>" class="footer__privacy">プライバシーポリシー</a>
      <small class="footer__copyright">Copyright &copy; ITAOKA KOSAKUSHO CO., LTD.</small>
      <a href="#top" class="footer__to-top-sp js-to-top" aria-label="ページ上部へ戻る">
        <img src="<?php echo IMAGEPATH; ?>/common/to-top_sp.svg" alt="" width="23" height="23">
      </a>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
