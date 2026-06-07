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
        <img src="<?php echo IMAGEPATH; ?>/facilities/facilities-mv.webp" alt="" width="2880" height="1093" class="sub-mv__image-img" fetchpriority="high">
      </picture>
    </div>
  </section>

  <?php
  $fac_dir = IMAGEPATH . '/facilities/';
  $facilities = [
    ['no' => '01', 'name' => 'オークマV920EX', 'size' => '', 'images' => [['facilities01_01', true], ['facilities01_02', false]]],
    ['no' => '02', 'name' => 'MULTUS B300II', 'size' => '', 'images' => [['facilities02_01', true], ['facilities02_02', false]]],
    ['no' => '03', 'name' => 'オークマLB3000EX（複合機）', 'size' => '', 'images' => [['facilities03_01', false]]],
    ['no' => '04', 'name' => 'オークマMB-66VB（マシニングセンター）', 'size' => '', 'images' => [['facilities04_02', false], ['facilities04_03', false]]],
    ['no' => '05', 'name' => 'オークマLB35II-M（複合機）', 'size' => '460φ×2000L', 'images' => [['facilities05_01', false], ['facilities05_02', false]]],
    ['no' => '06', 'name' => 'オークマLB4000EX（複合機）', 'size' => '480φ×1500L', 'images' => [['facilities06_01', false], ['facilities06_02', false], ['facilities06_03', false]]],
    ['no' => '07', 'name' => 'オークマLH35N', 'size' => '610φ×2000L', 'images' => [['facilities07_01', false], ['facilities07_02', false], ['facilities07_03', false]]],
    ['no' => '08', 'name' => 'オークマLB300M（複合機）', 'size' => '340φ×1000L', 'images' => [['facilities08_01', false]]],
  ];
  $facilities_text = [
    ['no' => '09', 'name' => '池貝A25旋盤（500φ×1500L）'],
    ['no' => '10', 'name' => '池貝A20旋盤（500φ×1100L）'],
    ['no' => '11', 'name' => '鋸盤'],
  ];
  ?>
  <section class="facilities">
    <div class="facilities__inner">

      <?php foreach ($facilities as $f) :
        $first = $f['images'][0];
      ?>
        <div class="facility">
          <div class="facility__head">
            <p class="facility__label">FACILITIES <?php echo esc_html($f['no']); ?></p>
            <h2 class="facility__name"><?php echo esc_html($f['name']); ?></h2>
            <?php if ($f['size']) : ?><p class="facility__size"><?php echo esc_html($f['size']); ?></p><?php endif; ?>
          </div>
          <div class="facility__gallery">
            <div class="facility__main<?php echo $first[1] ? ' is-white' : ''; ?>">
              <img src="<?php echo $fac_dir . $first[0]; ?>.webp" alt="<?php echo esc_attr($f['name']); ?>" class="facility__main-img" loading="lazy">
            </div>
            <ul class="facility__thumbs">
              <?php foreach ($f['images'] as $i => $img) : ?>
                <li class="facility__thumb<?php echo $i === 0 ? ' is-active' : ''; ?>" data-src="<?php echo $fac_dir . $img[0]; ?>.webp" data-white="<?php echo $img[1] ? '1' : '0'; ?>">
                  <img src="<?php echo $fac_dir . $img[0]; ?>.webp" alt="" loading="lazy">
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>

      <ul class="facility-list">
        <?php foreach ($facilities_text as $f) : ?>
          <li class="facility-list__item">
            <p class="facility__label">FACILITIES <?php echo esc_html($f['no']); ?></p>
            <h2 class="facility__name"><?php echo esc_html($f['name']); ?></h2>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </section>

</main>

<?php get_footer(); ?>