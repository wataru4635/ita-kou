<?php
/*
* Template Name: お問い合わせ
*/
?>
<?php get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">CONTACT</span>
        <span class="sub-mv__title-ja">お問い合わせ</span>
      </h1>
    </div>
  </section>

  <section class="contact-form">
    <div class="contact-form__inner">
      <p class="contact-form__intro">以下のフォームに必要事項を入力してください。</p>
      <hr class="contact-form__divider">

      <form id="contact-form" action="<?php echo CONTACT_CONFIRM_URL; ?>" method="post" class="contact-form__form" novalidate>
        <?php wp_nonce_field('contact_form_submit', 'contact_nonce'); ?>

        <dl class="contact-form__list">

          <div class="contact-form__item contact-form__item--type">
            <dt class="contact-form__label">
              <span class="contact-form__label-text">お問い合わせ内容</span><span class="contact-form__required">*</span>
            </dt>
            <dd class="contact-form__input">
              <ul class="contact-form__choices">
                <li class="contact-form__choice">
                  <label class="contact-form__choice-label">
                    <input type="checkbox" name="お問い合わせ内容[]" value="ご相談" class="contact-form__checkbox-input">
                    <span class="contact-form__checkbox" aria-hidden="true"></span>
                    <span class="contact-form__choice-text">ご相談</span>
                  </label>
                </li>
                <li class="contact-form__choice">
                  <label class="contact-form__choice-label">
                    <input type="checkbox" name="お問い合わせ内容[]" value="採用について" class="contact-form__checkbox-input">
                    <span class="contact-form__checkbox" aria-hidden="true"></span>
                    <span class="contact-form__choice-text">採用について</span>
                  </label>
                </li>
                <li class="contact-form__choice">
                  <label class="contact-form__choice-label">
                    <input type="checkbox" name="お問い合わせ内容[]" value="見積もり依頼" class="contact-form__checkbox-input">
                    <span class="contact-form__checkbox" aria-hidden="true"></span>
                    <span class="contact-form__choice-text">見積もり依頼</span>
                  </label>
                </li>
                <li class="contact-form__choice">
                  <label class="contact-form__choice-label">
                    <input type="checkbox" name="お問い合わせ内容[]" value="その他" class="contact-form__checkbox-input">
                    <span class="contact-form__checkbox" aria-hidden="true"></span>
                    <span class="contact-form__choice-text">その他</span>
                  </label>
                </li>
              </ul>
              <p class="contact-form__note">※営業メールはご遠慮ください。</p>
              <span id="type-error" class="error-message">いずれかを選択してください</span>
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">
              <label for="company" class="contact-form__label-text">会社名</label>
              <span class="contact-form__label-sub">（法人の場合）</span>
            </dt>
            <dd class="contact-form__input">
              <input type="text" id="company" name="会社名" class="contact-form__field" autocomplete="organization">
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">
              <label for="name" class="contact-form__label-text">氏名</label><span class="contact-form__required">*</span>
            </dt>
            <dd class="contact-form__input">
              <input type="text" id="name" name="氏名" class="contact-form__field" required aria-required="true" aria-describedby="name-error" autocomplete="name">
              <span id="name-error" class="error-message">この項目は必須です</span>
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">
              <label for="furigana" class="contact-form__label-text">フリガナ</label><span class="contact-form__required">*</span>
            </dt>
            <dd class="contact-form__input">
              <input type="text" id="furigana" name="フリガナ" class="contact-form__field" required aria-required="true" aria-describedby="furigana-error" autocomplete="additional-name">
              <span id="furigana-error" class="error-message">この項目は必須です</span>
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">
              <label for="email" class="contact-form__label-text">メールアドレス</label><span class="contact-form__required">*</span>
            </dt>
            <dd class="contact-form__input">
              <input type="email" id="email" name="メールアドレス" class="contact-form__field" required aria-required="true" aria-describedby="email-error" autocomplete="email">
              <span id="email-error" class="error-message">正しいメールアドレスを入力してください</span>
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">
              <label for="tel" class="contact-form__label-text">電話番号</label>
            </dt>
            <dd class="contact-form__input">
              <input type="tel" id="tel" name="電話番号" class="contact-form__field" placeholder="日中繋がりやすい電話番号を記載ください。" autocomplete="tel">
            </dd>
          </div>

          <div class="contact-form__item contact-form__item--address">
            <dt class="contact-form__label">
              <label for="address" class="contact-form__label-text">住所</label>
            </dt>
            <dd class="contact-form__input">
              <div class="contact-form__postal">
                <span class="contact-form__postal-mark">〒</span>
                <input type="text" id="postal" name="郵便番号" class="contact-form__field contact-form__field--postal" inputmode="numeric" autocomplete="postal-code" onKeyUp="AjaxZip3.zip2addr('郵便番号','','住所','住所');">
              </div>
              <input type="text" id="address" name="住所" class="contact-form__field" autocomplete="address-level1">
              <input type="text" name="建物名" class="contact-form__field" autocomplete="address-line2">
            </dd>
          </div>

        </dl>

        <hr class="contact-form__divider">

        <div class="contact-form__item contact-form__item--detail">
          <dt class="contact-form__label contact-form__label--detail">
            <label for="detail" class="contact-form__label-text">ご相談内容の詳細</label>
            <span class="contact-form__label-note">どんなことでも結構です。<br class="u-desktop-inline">自由に記載して下さい。</span>
          </dt>
          <dd class="contact-form__input">
            <textarea id="detail" name="ご相談内容の詳細" class="contact-form__textarea"></textarea>
          </dd>
        </div>

        <div class="contact-form__agreement">
          <label class="contact-form__agreement-label">
            <input type="checkbox" name="個人情報同意" value="同意する" class="contact-form__checkbox-input" required aria-required="true" aria-describedby="agreement-error">
            <span class="contact-form__checkbox" aria-hidden="true"></span>
            <span class="contact-form__agreement-text"><a href="<?php echo PRIVACY_POLICY_URL; ?>" class="contact-form__agreement-link" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>を確認しました。</span>
          </label>
          <span id="agreement-error" class="error-message">この項目は必須です</span>
        </div>

        <div class="contact-form__submit">
          <button type="submit" class="contact-form__submit-btn">内容を確認する</button>
        </div>
      </form>
    </div>
  </section>

</main>

<?php get_footer(); ?>