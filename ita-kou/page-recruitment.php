<?php
/*
* Template Name: 採用情報
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">RECRUITMENT</span>
        <span class="sub-mv__title-ja">採用情報</span>
      </h1>
    </div>
    <div class="sub-mv__image">
      <picture>
        <source srcset="<?php echo IMAGEPATH; ?>/recruitment/recruitment-mv_sp.webp" media="(max-width: 767px)">
        <img src="<?php echo IMAGEPATH; ?>/recruitment/recruitment-mv.webp" alt="" width="2880" height="1093" class="sub-mv__image-img" fetchpriority="high">
      </picture>
    </div>
  </section>

  <section class="recruitment-message">
    <div class="recruitment-message__inner js-fade-up">
      <h2 class="recruitment-message__title">求める人物像</h2>
      <p class="recruitment-message__text">私たちが求めているのは、<br>ものづくりに対して真摯に向き合える人です。<br><br class="u-desktop-inline">切削加工は、わずかな誤差が品質を大きく左右する仕事です。<br>だからこそ、一つひとつの作業に責任を持ち、丁寧に取り組める姿勢を大切にしています。<br><br class="u-desktop-inline">特別な経験や高度な技術がなくても構いません。<br>大切なのは、学ぶ意欲と、より良いものを追求し続ける気持ちです。<br><br class="u-desktop-inline">また、少数精鋭の環境だからこそ、一人ひとりの役割が大きく、チームワークも欠かせません。<br>周囲と協力しながら、自ら考え、行動できる方を歓迎します。<br><br class="u-desktop-inline">技術は、後からいくらでも身につけることができます。<br>しかし、ものづくりに向き合う姿勢だけは、簡単には身につきません。<br><br class="u-desktop-inline">私たちは、その“姿勢”を何よりも大切にしています。</p>
      <div class="recruitment-message__buttons">
        <a href="<?php echo SERVICES_URL; ?>" class="button">
          <span class="button__label">業務内容</span>
          <span class="button__arrow" aria-hidden="true"></span>
        </a>
        <a href="<?php echo COMPANY_URL; ?>" class="button">
          <span class="button__label">会社情報</span>
          <span class="button__arrow" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </section>

  <section class="recruitment-faq">
    <div class="recruitment-faq__inner js-fade-up">
      <h2 class="recruitment-faq__title">よくある質問</h2>
      <div class="recruitment-faq__list">
        <dl class="faq">
          <dt class="faq__q">
            <span class="faq__badge faq__badge--q">Q</span>
            <span class="faq__question">仕事内容を教えてください</span>
          </dt>
          <dd class="faq__a">
            <span class="faq__badge faq__badge--a">A</span>
            <span class="faq__answer">工作機械を使用し様々な部品を加工していくお仕事です。</span>
          </dd>
        </dl>
        <dl class="faq">
          <dt class="faq__q">
            <span class="faq__badge faq__badge--q">Q</span>
            <span class="faq__question">未経験でも大丈夫でしょうか？</span>
          </dt>
          <dd class="faq__a">
            <span class="faq__badge faq__badge--a">A</span>
            <span class="faq__answer">はじめは難しいかもしれませんが<br>先輩のサポートのもと徐々にステップアップして行ってもらいたいと思っています。</span>
          </dd>
        </dl>
        <dl class="faq">
          <dt class="faq__q">
            <span class="faq__badge faq__badge--q">Q</span>
            <span class="faq__question">何人くらいの方が勤めていますか？</span>
          </dt>
          <dd class="faq__a">
            <span class="faq__badge faq__badge--a">A</span>
            <span class="faq__answer">現在全員で7名が働いています。</span>
          </dd>
        </dl>
      </div>
    </div>
  </section>

  <section class="recruitment-guideline">
    <div class="recruitment-guideline__inner js-fade-up">
      <h2 class="recruitment-guideline__title">募集要項</h2>
      <div class="guideline-table">
        <div class="guideline-table__head">
          <p class="guideline-table__head-term">応募職種</p>
          <p class="guideline-table__head-value">NC及び汎用旋盤工</p>
        </div>
        <dl class="guideline-table__body">
          <div class="guideline-row">
            <dt class="guideline-row__term">業務内容</dt>
            <dd class="guideline-row__desc">NC旋盤及び汎用旋盤を使用した精密機械部品の加工業務です。<br>・射出成形機<br>・船舶の電気関係 等<br>・雑務（機械水補給等）</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">雇用形態</dt>
            <dd class="guideline-row__desc">正社員（試用期間 3か月）</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">募集人数</dt>
            <dd class="guideline-row__desc">1名（経験者優遇/見習い可）</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">給与</dt>
            <dd class="guideline-row__desc">月給202,700円～258,000円(定額諸手当含む) ※年齢・経験による<br>昇給有/賞与年2回</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">勤務場所</dt>
            <dd class="guideline-row__desc">〒651-2124<br>兵庫県神戸市西区伊川谷町潤和997-5（当社工場）<br>・JR明石駅から車で約10分<br>・神姫バス白水橋下車、徒歩で約4分</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">勤務時間</dt>
            <dd class="guideline-row__desc">8：30～17：30（実働8時間）※残業月5時間程度<br>休憩時間：休憩80分</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">応募資格</dt>
            <dd class="guideline-row__desc">年齢・学歴不問</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">休日・休暇</dt>
            <dd class="guideline-row__desc">週休二日制（土日祝休み）<br>※年末年始・お盆・GW<br>※6ヶ月経過後の年次有給休暇日数10日<br>※年間休日数130日</dd>
          </div>
          <div class="guideline-row">
            <dt class="guideline-row__term">福利厚生・待遇</dt>
            <dd class="guideline-row__desc">社会保険完備(健康保険・雇用保険・労災保険・厚生年金)<br>賞与有(夏・冬)<br>交通費（月額15,000円まで支給）<br>残業など各種手当有<br>車通勤可(駐車場有)</dd>
          </div>
        </dl>
      </div>
      <div class="recruitment-guideline__btn">
        <a href="<?php echo CONTACT_URL; ?>" class="button">
          <span class="button__label">エントリー</span>
          <span class="button__arrow" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>