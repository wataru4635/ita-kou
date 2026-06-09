<?php
/*
* Template Name: 業務内容
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">SERVICES</span>
        <span class="sub-mv__title-ja">業務内容</span>
      </h1>
    </div>
    <div class="sub-mv__image">
      <picture>
        <source srcset="<?php echo IMAGEPATH; ?>/services/services-mv_sp.webp" media="(max-width: 767px)">
        <img src="<?php echo IMAGEPATH; ?>/services/services-mv.webp" alt="工場内で工作機械を操作する作業者" width="2880" height="1093" class="sub-mv__image-img" fetchpriority="high">
      </picture>
    </div>
  </section>

  <section class="services">
    <div class="service">
      <div class="service__image js-service-scale-img">
        <img src="<?php echo IMAGEPATH; ?>/services/services_01.webp" alt="NC旋盤による精密切削加工" width="720" height="540" loading="lazy">
      </div>
      <div class="service__body">
        <div class="service__body-inner js-service-slide-right">
          <p class="service__label">SERVICES 01</p>
          <h2 class="service__title">精密切削加工</h2>
          <p class="service__text">金属材料を削り出し、図面通りの形状・精度で加工を行います。<br>当社では、原子力関連設備やLNG船のサブマージドポンプなどにも採用される品質基準に対応しており、ミクロン単位の精度が求められる加工においても、安定した品質を実現しています。<br>切削加工は、わずかな誤差が製品全体の性能や安全性に大きく影響するため、一つひとつの工程において高い精度と確かな技術が求められます。<br>長年培った職人の技術と最新設備を組み合わせることで、高精度かつ再現性の高いものづくりを行っています。</p>
        </div>
      </div>
    </div>

    <div class="service service--reverse">
      <div class="service__image js-service-scale-img">
        <img src="<?php echo IMAGEPATH; ?>/services/services_02.webp" alt="汎用旋盤でモータ部品を加工する職人" width="720" height="540" loading="lazy">
      </div>
      <div class="service__body">
        <div class="service__body-inner js-service-slide-right">
          <p class="service__label">SERVICES 02</p>
          <h2 class="service__title">モータ部品加工</h2>
          <p class="service__text">創業当初は原子力発電所向けポンプ部品にたずさわり、現在はサブマージドポンプモータの部品加工を主軸としております。<br>サブマージドポンプモータ部品は、耐久性・精度・信頼性が求められる重要な部品です。<br>わずかなズレが性能に影響を与えるため、安定した加工技術が不可欠です。<br>これまで培ってきた経験と技術をもとに、用途や仕様に応じた最適な加工を行い、高品質な製品を提供しています。</p>
        </div>
      </div>
    </div>

    <div class="service">
      <div class="service__image js-service-scale-img">
        <img src="<?php echo IMAGEPATH; ?>/services/services_03.webp" alt="工場でNC旋盤を操作する作業者" width="720" height="540" loading="lazy">
      </div>
      <div class="service__body">
        <div class="service__body-inner js-service-slide-right">
          <p class="service__label">SERVICES 03</p>
          <h2 class="service__title">幅広い分野への対応力</h2>
          <p class="service__text">社会インフラを支える設備から一般産業機械、さらには射出成形機に至るまで、幅広い分野の部品加工に対応しています。<br>それぞれの用途や使用環境に応じて求められる精度・耐久性・信頼性に対し、これまで培ってきた技術と経験を活かし、最適な加工方法を選定。<br>安定した品質と高い再現性で、多様なニーズに応えるものづくりを実現しています。</p>
        </div>
      </div>
    </div>

    <div class="service service--reverse">
      <div class="service__image js-service-scale-img">
        <img src="<?php echo IMAGEPATH; ?>/services/services_04.webp" alt="棚に整理された測定具と検査用工具" width="720" height="540" loading="lazy">
      </div>
      <div class="service__body">
        <div class="service__body-inner js-service-slide-right">
          <p class="service__label">SERVICES 04</p>
          <h2 class="service__title">一貫対応と柔軟な対応力、<br>そして徹底した品質管理</h2>
          <p class="service__text">ご相談から製作まで、すべての工程に責任を持って対応いたします。<br>少数精鋭の体制だからこそ可能な、きめ細やかな対応と迅速な意思決定により、お客様のご要望に的確にお応えします。<br>また、一品一様の加工や小ロットのご依頼にも柔軟に対応し、用途や仕様に応じて最適な加工方法を選定。さらに、各工程において徹底した品質管理を行い、安定した品質を維持しています。<br>細かなご要望にも丁寧に向き合い、スピード感のある対応と柔軟な判断、そして確かな品質で、多様なニーズに応えるものづくりを実現しています。<br>一つひとつの仕事に真摯に向き合い、信頼されるパートナーとして長くお付き合いいただける関係を築いていきます。</p>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>