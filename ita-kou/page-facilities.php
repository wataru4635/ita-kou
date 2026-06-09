<?php
/*
* Template Name: 設備紹介
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">FACILITIES</span>
        <span class="sub-mv__title-ja">設備紹介</span>
      </h1>
    </div>
    <div class="sub-mv__image">
      <picture>
        <source srcset="<?php echo IMAGEPATH; ?>/facilities/facilities-mv_sp.webp" media="(max-width: 767px)">
        <img src="<?php echo IMAGEPATH; ?>/facilities/facilities-mv.webp" alt="工場内に並ぶオークマ製の工作機械" width="2880" height="1093" class="sub-mv__image-img" fetchpriority="high">
      </picture>
    </div>
  </section>

  <section class="facilities">
    <div class="facilities__inner">

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 01</p>
          <h2 class="facility__name">オークマV920EX</h2>
        </div>
        <div class="facility__gallery">
          <div class="facility__main is-white">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities01_01.webp" alt="オークマV920EX" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities01_01.webp" data-white="1">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities01_01.webp" alt="オークマV920EX" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities01_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities01_02.webp" alt="オークマV920EX" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 02</p>
          <h2 class="facility__name">MULTUS B300II</h2>
        </div>
        <div class="facility__gallery">
          <div class="facility__main is-white">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities02_01.webp" alt="MULTUS B300II" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities02_01.webp" data-white="1">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities02_01.webp" alt="MULTUS B300II" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities02_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities02_02.webp" alt="MULTUS B300II" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 03</p>
          <h2 class="facility__name">オークマLB3000EX（複合機）</h2>
        </div>
        <div class="facility__gallery">
          <div class="facility__main">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities03_01.webp" alt="オークマLB3000EX（複合機）" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities03_01.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities03_01.webp" alt="オークマLB3000EX（複合機）" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 04</p>
          <h2 class="facility__name">オークマMB-66VB（マシニングセンター）</h2>
        </div>
        <div class="facility__gallery">
          <div class="facility__main is-white">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities04_01.webp" alt="オークマMB-66VB（マシニングセンター）" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities04_01.webp" data-white="1">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities04_01.webp" alt="オークマMB-66VB（マシニングセンター）" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities04_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities04_02.webp" alt="オークマMB-66VB（マシニングセンター）" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities04_03.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities04_03.webp" alt="オークマMB-66VB（マシニングセンター）" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 05</p>
          <h2 class="facility__name">オークマLB35II-M（複合機）</h2>
          <p class="facility__size">460φ×2000L</p>
        </div>
        <div class="facility__gallery">
          <div class="facility__main">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities05_01.webp" alt="オークマLB35II-M（複合機）" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities05_01.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities05_01.webp" alt="オークマLB35II-M（複合機）" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities05_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities05_02.webp" alt="オークマLB35II-M（複合機）" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 06</p>
          <h2 class="facility__name">オークマLB4000EX（複合機）</h2>
          <p class="facility__size">480φ×1500L</p>
        </div>
        <div class="facility__gallery">
          <div class="facility__main">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities06_01.webp" alt="オークマLB4000EX（複合機）" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities06_01.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities06_01.webp" alt="オークマLB4000EX（複合機）" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities06_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities06_02.webp" alt="オークマLB4000EX（複合機）" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities06_03.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities06_03.webp" alt="オークマLB4000EX（複合機）" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 07</p>
          <h2 class="facility__name">オークマLH35N</h2>
          <p class="facility__size">610φ×2000L</p>
        </div>
        <div class="facility__gallery">
          <div class="facility__main">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities07_01.webp" alt="オークマLH35N" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities07_01.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities07_01.webp" alt="オークマLH35N" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities07_02.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities07_02.webp" alt="オークマLH35N" loading="lazy">
            </li>
            <li class="facility__thumb" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities07_03.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities07_03.webp" alt="オークマLH35N" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <div class="facility">
        <div class="facility__head">
          <p class="facility__label">FACILITIES 08</p>
          <h2 class="facility__name">オークマLB300M（複合機）</h2>
          <p class="facility__size">340φ×1000L</p>
        </div>
        <div class="facility__gallery">
          <div class="facility__main">
            <img src="<?php echo IMAGEPATH; ?>/facilities/facilities08_01.webp" alt="オークマLB300M（複合機）" class="facility__main-img" loading="lazy">
          </div>
          <ul class="facility__thumbs">
            <li class="facility__thumb is-active" data-src="<?php echo IMAGEPATH; ?>/facilities/facilities08_01.webp" data-white="0">
              <img src="<?php echo IMAGEPATH; ?>/facilities/facilities08_01.webp" alt="オークマLB300M（複合機）" loading="lazy">
            </li>
          </ul>
        </div>
      </div>

      <ul class="facility-list">
        <li class="facility-list__item">
          <p class="facility__label">FACILITIES 09</p>
          <h2 class="facility__name">池貝 A25 旋盤（500φ×1500L）</h2>
        </li>
        <li class="facility-list__item">
          <p class="facility__label">FACILITIES 10</p>
          <h2 class="facility__name">池貝 A20 旋盤（500φ×1100L）</h2>
        </li>
        <li class="facility-list__item">
          <p class="facility__label">FACILITIES 11</p>
          <h2 class="facility__name">鋸盤</h2>
        </li>
      </ul>

    </div>
  </section>

</main>

<?php get_footer(); ?>
