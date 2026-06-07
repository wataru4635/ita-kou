<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <?php if(is_page('contact')): ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <?php else: ?>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <?php endif; ?>
  <meta name="format-detection" content="telephone=no" />
  <meta name="keywords" content="有限会社板岡工作所,板岡工作所,精密切削加工,精密機械部品加工,切削加工,NC旋盤,汎用旋盤,旋盤加工,モータ部品加工,サブマージドポンプ,射出成形機部品,小ロット加工,神戸市西区,兵庫県" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header class="header">
    <div class="header__inner">
      <?php
      $is_top   = (is_front_page() || is_home());
      $logo_tag = $is_top ? 'h1' : 'div';
      $logo_img = $is_top ? 'logo.svg' : 'logo-black.svg';
      ?>
      <<?php echo esc_attr($logo_tag); ?> class="header__logo">
        <a href="<?php echo HOME_URL; ?>" class="header__logo-link">
          <img src="<?php echo IMAGEPATH; ?>/common/<?php echo $logo_img; ?>" alt="有限会社 板岡工作所" class="header__logo-img"
            width="306" height="50" fetchpriority="high">
        </a>
      </<?php echo esc_attr($logo_tag); ?>>

      <nav class="header__nav" aria-label="グローバルナビゲーション">
        <ul class="header__nav-items">
          <li class="header__nav-item">
            <a href="<?php echo HOME_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">TOP</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo SERVICES_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">業務内容</span>
              <span class="header__nav-en">SERVICES</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo FACILITIES_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">設備紹介</span>
              <span class="header__nav-en">FACILITIES</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo COMPANY_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">会社情報</span>
              <span class="header__nav-en">COMPANY</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo RECRUITMENT_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">採用情報</span>
              <span class="header__nav-en">RECRUITMENT</span>
            </a>
          </li>
          <li class="header__nav-item header__nav-item--contact">
            <a href="<?php echo CONTACT_URL; ?>" class="header__nav-link">
              <span class="header__nav-jp">お問い合わせ</span>
              <span class="header__nav-en">CONTACT</span>
            </a>
          </li>
        </ul>
      </nav>

      <button class="header__hamburger js-hamburger" type="button" aria-label="メニューを開く" aria-expanded="false"
        aria-controls="js-drawer">
        <span class="header__hamburger-bar"></span>
        <span class="header__hamburger-bar"></span>
      </button>

      <div class="header__drawer js-drawer" id="js-drawer">
        <div class="header__drawer-head">
          <div class="header__drawer-logo">
            <a href="<?php echo HOME_URL; ?>">
              <img src="<?php echo IMAGEPATH; ?>/common/logo-black.svg" alt="有限会社 板岡工作所"
                class="header__drawer-logo-img" width="306" height="50">
            </a>
          </div>
          <button class="header__drawer-close js-drawer-close" type="button" aria-label="メニューを閉じる"></button>
        </div>

        <nav class="header__drawer-nav" aria-label="モバイルナビゲーション">
          <ul class="header__drawer-items">
            <li class="header__drawer-item">
              <a href="<?php echo HOME_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">トップページ</span>
                  <span class="header__drawer-en">TOP</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo SERVICES_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">業務内容</span>
                  <span class="header__drawer-en">SERVICES</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo FACILITIES_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">設備紹介</span>
                  <span class="header__drawer-en">FACILITIES</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo COMPANY_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">会社情報</span>
                  <span class="header__drawer-en">COMPANY</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo RECRUITMENT_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">採用情報</span>
                  <span class="header__drawer-en">RECRUITMENT</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo CONTACT_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">お問い合わせ</span>
                  <span class="header__drawer-en">CONTACT</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
            <li class="header__drawer-item">
              <a href="<?php echo PRIVACY_POLICY_URL; ?>" class="header__drawer-link">
                <span class="header__drawer-label">
                  <span class="header__drawer-jp">プライバシーポリシー</span>
                  <span class="header__drawer-en">PRIVACY POLICY</span>
                </span>
                <span class="header__drawer-arrow">
                  <img src="<?php echo IMAGEPATH; ?>/common/arrow-blue.svg" alt="" width="15" height="15">
                </span>
              </a>
            </li>
          </ul>
        </nav>

        <p class="header__drawer-copyright">Copyright &copy; ITAOKA KOSAKUSHO CO., LTD.</p>
      </div>
    </div>
  </header>
