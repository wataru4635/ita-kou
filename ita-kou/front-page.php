<?php
/*
* Template Name: トップページ
*/
?>
<?php get_header(); ?>

<main>

  <section class="mv">
    <div class="mv__slider swiper js-mv-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <picture>
            <source srcset="<?php echo IMAGEPATH; ?>/top/mv_01_sp.webp" media="(max-width: 767px)">
            <img src="<?php echo IMAGEPATH; ?>/top/mv_01.webp" alt="工場で旋盤を使い金属部品を加工する職人" loading="eager" fetchpriority="high">
          </picture>
        </div>
        <div class="swiper-slide">
          <picture>
            <source srcset="<?php echo IMAGEPATH; ?>/top/mv_02_sp.webp" media="(max-width: 767px)">
            <img src="<?php echo IMAGEPATH; ?>/top/mv_02.webp" alt="NC旋盤のタレットによる精密切削加工" loading="lazy">
          </picture>
        </div>
        <div class="swiper-slide">
          <picture>
            <source srcset="<?php echo IMAGEPATH; ?>/top/mv_03_sp.webp" media="(max-width: 767px)">
            <img src="<?php echo IMAGEPATH; ?>/top/mv_03.webp" alt="工場でNC旋盤を操作する作業者" loading="lazy">
          </picture>
        </div>
      </div>
    </div>

    <div class="swiper-pagination js-mv-pagination mv__pagination"></div>

    <div class="mv__copy">
      <div class="mv__copy-row">
        <p class="mv__catch">精度に妥協しない。<br>選ばれるものづくり。</p>
        <div class="mv__en-group">
          <p class="mv__en mv__en--left">Precision without compromise.</p>
          <p class="mv__en mv__en--right">Manufacturing that earns trust.</p>
        </div>
      </div>
    </div>

    <p class="mv__scroll">scroll</p>
  </section>

  <section class="top-slogan">
    <picture class="top-slogan__bg">
      <source srcset="<?php echo IMAGEPATH; ?>/top/top-slogan-bg_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo IMAGEPATH; ?>/top/top-slogan-bg.webp" alt="汎用旋盤で金属部品を加工する職人" class="top-slogan__bg-img" loading="lazy">
    </picture>
    <div class="top-slogan__inner">
      <div class="top-slogan__title js-fade-up">
        <h2 class="top-slogan__title-jp">板岡工作所のスローガン</h2>
        <span class="top-slogan__title-en">SLOGAN</span>
      </div>
      <p class="top-slogan__catch js-fade-up">「職人の技術と最新設備の融合」</p>
      <p class="top-slogan__text js-fade-up">受け継がれる職人の技。進化を続ける最新設備。<br class="u-desktop-inline">その融合が、常識を超える品質を生み出します。<br><br class="u-desktop-inline">一つひとつの工程に宿る熟練の技術と、精度を極限まで高めるテクノロジー。<br class="u-desktop-inline">その両輪が支え合うことで、私たちは常に安定した高品質と、<br class="u-desktop-inline">時代のニーズに応える柔軟なものづくりを実現してきました。<br><br class="u-desktop-inline">私たちは、人の手だからこそ生まれる繊細さと、機械だからこそ実現できる正確さ、<br class="u-desktop-inline">そのどちらも欠かすことなく追求し続けています。<br class="u-desktop-inline">目に見える品質だけでなく、その先にある安心や信頼までも提供すること。<br class="u-desktop-inline">それが、私たちの使命です。<br><br class="u-desktop-inline">人と技術の可能性を最大限に引き出し、新たな価値を創造し続ける。<br class="u-desktop-inline">これからも私たちは、伝統と革新を融合させながら、<br class="u-desktop-inline">次の時代へとつながるものづくりに挑戦し続けます。</p>
      <ul class="top-slogan__images">
        <li class="top-slogan__image js-fade-up">
          <img src="<?php echo IMAGEPATH; ?>/top/top-slogan_01.webp" alt="NC旋盤のタレット部" width="383" height="369" loading="lazy">
        </li>
        <li class="top-slogan__image js-fade-up --delay-1">
          <img src="<?php echo IMAGEPATH; ?>/top/top-slogan_02.webp" alt="汎用旋盤で部品を加工する職人" width="383" height="369" loading="lazy">
        </li>
        <li class="top-slogan__image js-fade-up --delay-2">
          <img src="<?php echo IMAGEPATH; ?>/top/top-slogan_03.webp" alt="NC旋盤を操作する作業者" width="383" height="369" loading="lazy">
        </li>
      </ul>
    </div>
  </section>

  <section class="top-services">
    <div class="top-services__inner">
      <div class="top-services__body">
        <div class="top-services__title js-split-heading">
          <h2 class="top-services__title-jp js-text-split">業務内容</h2>
          <span class="top-services__title-en">SERVICES</span>
        </div>
        <div class="top-services__body-inner js-top-services-slide-right">
          <p class="top-services__lead">しっかりとした工程管理の元、<br>高精度、高品質を実現する加工技術。</p>
          <p class="top-services__text">精密切削加工を中心に、ポンプ部品をはじめとした各種機械部品の製造を行っています。<br>原子力関連設備やLNG船のサブマージドポンプなど、高い信頼性が求められる分野にも対応し、社会インフラを支える製品づくりに携わっています。<br>用途や使用環境に応じて求められる性能を的確に捉え、最適な加工方法をご提案。<br>ミクロン単位の精度が求められる加工においても、一つひとつの工程で品質を徹底的に追求し、安定した製品を実現しています。<br>また、少数精鋭の体制を活かし、多品種・小ロットにも柔軟に対応。<br>ご相談から製作まで一貫して対応することで、スピーディーかつ的確なものづくりを提供します。</p>
          <div class="top-services__btn">
            <a href="<?php echo SERVICES_URL; ?>" class="button button--gray">
              <span class="button__label">詳しく見る</span>
              <span class="button__arrow" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="top-services__images js-top-services-scale-img">
        <div class="top-services__img top-services__img--top">
          <img src="<?php echo IMAGEPATH; ?>/top/top-services_01.webp" alt="工作機械を操作する作業者" width="328" height="410" loading="lazy">
        </div>
        <div class="top-services__img top-services__img--bottom">
          <img src="<?php echo IMAGEPATH; ?>/top/top-services_02.webp" alt="工場でNC旋盤を操作する作業者" width="657" height="433" loading="lazy">
        </div>
      </div>
    </div>
  </section>

  <section class="top-equipment">
    <picture class="top-equipment__bg">
      <source srcset="<?php echo IMAGEPATH; ?>/top/top-equipment-bg_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo IMAGEPATH; ?>/top/top-equipment-bg.webp" alt="天井クレーンを備えた工場内に並ぶ工作機械" class="top-equipment__bg-img" loading="lazy">
    </picture>
    <div class="top-equipment__inner">
      <div class="top-equipment__head">
        <div class="top-equipment__title js-split-heading">
          <h2 class="top-equipment__title-jp js-text-split">設備紹介</h2>
          <span class="top-equipment__title-en">EQUIPMENT</span>
        </div>
      </div>
      <div class="top-equipment__machines js-top-equipment-scale-img">
        <picture>
          <source srcset="<?php echo IMAGEPATH; ?>/top/top-equipment_sp.webp" media="(max-width: 767px)">
          <img src="<?php echo IMAGEPATH; ?>/top/top-equipment.webp" alt="工作機械" width="587" height="768" loading="lazy">
        </picture>
      </div>
      <div class="top-equipment__body js-top-equipment-slide-right">
        <p class="top-equipment__lead">技術と最新設備の融合で安定した<br>品質と高い生産性を実現。</p>
        <p class="top-equipment__text">当社では、精度と安定性を追求するため、高性能な工作機械を導入し、加工環境の整備に取り組んでいます。<br>最新設備による高い加工精度と、長年培ってきた職人の技術を組み合わせることで、ミクロン単位の精度が求められる加工にも安定して対応しています。<br>また、多様な加工ニーズに応えるため、用途に応じた設備を活用し、効率的かつ柔軟な生産体制を構築。<br>品質と生産性の両立を実現し、お客様の信頼に応えるものづくりを支えています。</p>
        <div class="top-equipment__btn">
          <a href="<?php echo FACILITIES_URL; ?>" class="button">
            <span class="button__label">詳しく見る</span>
            <span class="button__arrow" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="page-links">
    <ul class="page-links__list">
      <li class="page-links__item">
        <a href="<?php echo COMPANY_URL; ?>" class="page-links__card">
          <img src="<?php echo IMAGEPATH; ?>/common/page-links-company-bg.webp" alt="「有限会社 板岡工作所」の社屋外観" class="page-links__bg" loading="lazy">
          <div class="page-links__content">
            <p class="page-links__title">会社情報<span class="page-links__en">COMPANY</span></p>
            <span class="button page-links__btn">
              <span class="button__label">詳しく見る</span>
              <span class="button__arrow" aria-hidden="true"></span>
            </span>
          </div>
        </a>
      </li>
      <li class="page-links__item">
        <a href="<?php echo RECRUITMENT_URL; ?>" class="page-links__card">
          <img src="<?php echo IMAGEPATH; ?>/common/page-links-recruitment-bg.webp" alt="作業台に並んだマイクロメーターなどの精密測定器" class="page-links__bg" loading="lazy">
          <div class="page-links__content">
            <p class="page-links__title">採用情報<span class="page-links__en">RECRUITMENT</span></p>
            <span class="button page-links__btn">
              <span class="button__label">詳しく見る</span>
              <span class="button__arrow" aria-hidden="true"></span>
            </span>
          </div>
        </a>
      </li>
    </ul>
  </section>

</main>

<?php get_footer(); ?>
