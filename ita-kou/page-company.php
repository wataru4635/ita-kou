<?php
/*
* Template Name: 会社情報
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">COMPANY</span>
        <span class="sub-mv__title-ja">会社情報</span>
      </h1>
    </div>
    <div class="sub-mv__image">
      <picture>
        <source srcset="<?php echo IMAGEPATH; ?>/company/company-mv_sp.webp" media="(max-width: 767px)">
        <img src="<?php echo IMAGEPATH; ?>/company/company-mv.webp" alt="" width="2880" height="1093" class="sub-mv__image-img" fetchpriority="high">
      </picture>
    </div>
  </section>

  <section class="company-greeting">
    <div class="company-greeting__inner">
      <div class="company-greeting__head">
        <p class="company-greeting__label js-fade-up">代表挨拶</p>
      </div>
      <div class="company-greeting__image js-scaleImg">
        <img src="<?php echo IMAGEPATH; ?>/company/company-greeting.webp" alt="工場で図面を確認する板岡工作所のスタッフ" width="680" height="662" loading="lazy">
      </div>
      <div class="company-greeting__body js-fade-up">
        <h2 class="company-greeting__title">一切の妥協なき切削加工へのこだわり</h2>
        <p class="company-greeting__text">有限会社板岡工作所は、兵庫県神戸市西区にて機械用部品の切削加工を行っております。<br>私たちは少数精鋭の体制のもと、すべての工程に責任を持ち、精度を追求したものづくりを続けてまいりました。<br>切削加工は、わずかな誤差が製品全体の品質を左右する仕事です。だからこそ、一つひとつの工程に妥協せず、確かな技術と誠実な姿勢で向き合うことを大切にしています。<br>少数精鋭だからこそ可能な、細やかな対応力と迅速な判断力。<br>お客様のご要望に真摯に応え、信頼されるパートナーであり続けることが私たちの使命です。<br>これからも地域に根ざした加工会社として、品質第一の姿勢を貫き、ものづくりを通じて社会に貢献してまいります。</p>
        <p class="company-greeting__name">代表取締役　板岡 博史</p>
      </div>
    </div>
  </section>

  <section class="company-philosophy">
    <div class="company-philosophy__inner js-fade-up">
      <div class="company-philosophy__block">
        <h2 class="company-philosophy__heading">スローガン</h2>
        <p class="company-philosophy__slogan-title">職人の技術と最新設備の融合</p>
        <p class="company-philosophy__lead">受け継がれる職人の技。進化を続ける最新設備。<br>その融合が、常識を超える品質を生み出します。</p>
        <p class="company-philosophy__text">一つひとつの工程に宿る熟練の技術と、精度を極限まで高めるテクノロジー。<br>その両輪によって、私たちは安定した高品質と、時代のニーズに応える柔軟なものづくりを実現しています。<br><br>私たちは、人の手だからこそ生まれる繊細さと、機械だからこそ実現できる正確さ、<br>そのどちらも妥協することなく追求し続けています。<br>目に見える品質だけでなく、その先にある安心や信頼まで届けること。<br>それが、私たちの使命です。</p>
      </div>

      <hr class="company-philosophy__divider">

      <div class="company-philosophy__block">
        <h2 class="company-philosophy__heading">基本方針</h2>
        <dl class="company-philosophy__items">
          <div class="philosophy-item">
            <dt class="philosophy-item__term">品質</dt>
            <dd class="philosophy-item__desc">常に高精度を追求し、安定した品質でお応えします。</dd>
          </div>
          <div class="philosophy-item">
            <dt class="philosophy-item__term">納期</dt>
            <dd class="philosophy-item__desc">確かな工程管理と迅速な判断で、信頼される納期を守ります。</dd>
          </div>
          <div class="philosophy-item">
            <dt class="philosophy-item__term">環境</dt>
            <dd class="philosophy-item__desc">地域と環境に配慮し、持続可能なものづくりに取り組みます。</dd>
          </div>
        </dl>
        <p class="company-philosophy__statement">人と技術の可能性を最大限に引き出し、新たな価値を創造し続ける。<br>これからも私たちは、伝統と革新を融合させながら、<br>次の時代へとつながるものづくりに挑戦し続けます。</p>
      </div>
    </div>
  </section>

  <section class="company-profile">
    <div class="company-profile__inner js-fade-up">
      <h2 class="company-profile__title">会社概要</h2>
      <div class="company-profile__table">
        <dl class="company-profile__col company-profile__col--left">
          <div class="profile-row">
            <dt class="profile-row__term">会社名</dt>
            <dd class="profile-row__desc">有限会社 板岡工作所</dd>
          </div>
          <div class="profile-row">
            <dt class="profile-row__term">代表者</dt>
            <dd class="profile-row__desc">代表取締役　板岡 博史</dd>
          </div>
          <div class="profile-row profile-row--address">
            <dt class="profile-row__term">住所</dt>
            <dd class="profile-row__desc">
              <div class="profile-address">
                <div class="profile-address__row">
                  <span class="profile-address__label">本社</span>
                  <span class="profile-address__detail">〒651-2114 兵庫県神戸市西区今寺 36-11<br>TEL（078）975-2023　FAX（078）975-3063</span>
                </div>
                <div class="profile-address__row">
                  <span class="profile-address__label">工場</span>
                  <span class="profile-address__detail">〒651-2124 兵庫県神戸市西区伊川谷町潤和 997-5<br>TEL（078）975-7557　FAX（078）975-7527</span>
                </div>
              </div>
            </dd>
          </div>
        </dl>
        <dl class="company-profile__col company-profile__col--right">
          <div class="profile-row">
            <dt class="profile-row__term">設立</dt>
            <dd class="profile-row__desc">平成12年12月</dd>
          </div>
          <div class="profile-row">
            <dt class="profile-row__term">資本金</dt>
            <dd class="profile-row__desc">300万円</dd>
          </div>
          <div class="profile-row">
            <dt class="profile-row__term">事業内容</dt>
            <dd class="profile-row__desc">機械部品加工</dd>
          </div>
          <div class="profile-row profile-row--clients">
            <dt class="profile-row__term">主な取引先</dt>
            <dd class="profile-row__desc">・西芝電機株式会社<br>・新明和工業株式会社小野工場<br>・TOYOイノベックス株式会社<br class="u-mobile-inline">&nbsp;（旧 東洋機械金属株式会社）<br>・株式会社松田ポンプ製作所</dd>
          </div>
        </dl>
      </div>
    </div>
  </section>

  <section class="company-history">
    <div class="company-history__inner js-fade-up">
      <h2 class="company-history__title">沿革</h2>
      <div class="company-history__list">
        <div class="history-row">
          <span class="history-row__year">昭和52年</span>
          <span class="history-row__month">1月</span>
          <p class="history-row__event">板岡工作所創立（兵庫県神戸市東灘区魚崎南町2丁目）<br>原子力発電所向けポンプ部品の製造からスタート</p>
        </div>
        <div class="history-row">
          <span class="history-row__year">平成5年</span>
          <span class="history-row__month">8月</span>
          <p class="history-row__event">神戸市西区今寺36-11に移転</p>
        </div>
        <div class="history-row">
          <span class="history-row__year">平成12年</span>
          <span class="history-row__month">12月</span>
          <p class="history-row__event">有限会社板岡工作所設立</p>
        </div>
        <div class="history-row">
          <span class="history-row__year">平成18年</span>
          <span class="history-row__month">4月</span>
          <p class="history-row__event">神戸市西区伊川谷町潤和997-5に工場移転</p>
        </div>
        <div class="history-row">
          <span class="history-row__year">令和7年</span>
          <span class="history-row__month">9月</span>
          <p class="history-row__event">代表取締役が板岡 博より板岡 博史へ交代</p>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>