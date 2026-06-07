<?php
/*
* Template Name: お問い合わせ確認
*/

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$has_post    = !empty($_POST) && !empty($_POST['contact_nonce']);
$nonce_valid = $has_post && wp_verify_nonce($_POST['contact_nonce'], 'contact_form_submit');

if ($nonce_valid) {
  $types = isset($_POST['お問い合わせ内容']) && is_array($_POST['お問い合わせ内容'])
    ? array_map('sanitize_text_field', $_POST['お問い合わせ内容'])
    : [];

  $data = [
    'お問い合わせ内容'   => $types,
    '会社名'             => sanitize_text_field($_POST['会社名']             ?? ''),
    '氏名'               => sanitize_text_field($_POST['氏名']               ?? ''),
    'フリガナ'           => sanitize_text_field($_POST['フリガナ']           ?? ''),
    'メールアドレス'     => sanitize_email     ($_POST['メールアドレス']     ?? ''),
    '電話番号'           => sanitize_text_field($_POST['電話番号']           ?? ''),
    '郵便番号'           => sanitize_text_field($_POST['郵便番号']           ?? ''),
    '住所'               => sanitize_text_field($_POST['住所']               ?? ''),
    '建物名'             => sanitize_text_field($_POST['建物名']             ?? ''),
    'ご相談内容の詳細'   => sanitize_textarea_field($_POST['ご相談内容の詳細'] ?? ''),
  ];

  // スパム対策: 詳細に入力があるのに日本語が含まれない場合は弾く
  if (
    $data['ご相談内容の詳細'] !== ''
    && ! preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $data['ご相談内容の詳細'])
  ) {
    wp_safe_redirect(CONTACT_URL);
    exit;
  }

  $_SESSION['contact_data'] = $data;
} elseif (!empty($_SESSION['contact_data']) && is_array($_SESSION['contact_data'])) {
  $data = $_SESSION['contact_data'];
} else {
  wp_safe_redirect(CONTACT_URL);
  exit;
}

/** hidden で送信フォームに渡す再帰関数 */
function itaoka_render_hidden_inputs($name, $value) {
  if (is_array($value)) {
    foreach ($value as $v) {
      printf('<input type="hidden" name="%s[]" value="%s">', esc_attr($name), esc_attr($v));
    }
  } else {
    printf('<input type="hidden" name="%s" value="%s">', esc_attr($name), esc_attr($value));
  }
}

get_header(); ?>

<main>

  <section class="sub-mv">
    <div class="sub-mv__head">
      <h1 class="sub-mv__title">
        <span class="sub-mv__title-en">CONTACT</span>
        <span class="sub-mv__title-ja">お問い合わせ</span>
      </h1>
    </div>
  </section>

  <section class="contact-form contact-form--confirm">
    <div class="contact-form__inner">
      <p class="contact-form__intro">入力内容をご確認の上、「送信する」ボタンを押してください。</p>
      <hr class="contact-form__divider">

      <form id="contact-confirm-form" action="<?php echo CONTACT_THANKS_URL; ?>" method="post" class="contact-form__form">
        <?php wp_nonce_field('contact_form_confirm', 'contact_confirm_nonce'); ?>
        <?php foreach ($data as $name => $value) : ?>
          <?php itaoka_render_hidden_inputs($name, $value); ?>
        <?php endforeach; ?>

        <dl class="contact-form__list">

          <div class="contact-form__item">
            <dt class="contact-form__label">お問い合わせ内容</dt>
            <dd class="contact-form__confirm-value">
              <?php echo $data['お問い合わせ内容'] ? esc_html(implode('／', $data['お問い合わせ内容'])) : '—'; ?>
            </dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">会社名</dt>
            <dd class="contact-form__confirm-value"><?php echo $data['会社名'] !== '' ? esc_html($data['会社名']) : '—'; ?></dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">氏名</dt>
            <dd class="contact-form__confirm-value"><?php echo esc_html($data['氏名']); ?></dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">フリガナ</dt>
            <dd class="contact-form__confirm-value"><?php echo esc_html($data['フリガナ']); ?></dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">メールアドレス</dt>
            <dd class="contact-form__confirm-value"><?php echo esc_html($data['メールアドレス']); ?></dd>
          </div>

          <div class="contact-form__item">
            <dt class="contact-form__label">電話番号</dt>
            <dd class="contact-form__confirm-value"><?php echo $data['電話番号'] !== '' ? esc_html($data['電話番号']) : '—'; ?></dd>
          </div>

          <div class="contact-form__item contact-form__item--address">
            <dt class="contact-form__label">住所</dt>
            <dd class="contact-form__confirm-value">
              <?php if ($data['郵便番号'] !== '') : ?>〒<?php echo esc_html($data['郵便番号']); ?><br><?php endif; ?>
              <?php echo esc_html($data['住所']); ?>
              <?php if ($data['建物名'] !== '') : ?><br><?php echo esc_html($data['建物名']); ?><?php endif; ?>
              <?php if ($data['郵便番号'] === '' && $data['住所'] === '' && $data['建物名'] === '') : ?>—<?php endif; ?>
            </dd>
          </div>

        </dl>

        <hr class="contact-form__divider">

        <div class="contact-form__item contact-form__item--detail">
          <dt class="contact-form__label contact-form__label--detail">ご相談内容の詳細</dt>
          <dd class="contact-form__confirm-value contact-form__confirm-value--detail">
            <?php echo $data['ご相談内容の詳細'] !== '' ? nl2br(esc_html($data['ご相談内容の詳細'])) : '—'; ?>
          </dd>
        </div>

        <div class="contact-form__submit contact-form__submit--confirm">
          <button type="button" class="contact-form__back-btn" onclick="history.back();">修正する</button>
          <button type="submit" class="contact-form__submit-btn">送信する</button>
        </div>
      </form>
    </div>
  </section>

</main>

<?php get_footer(); ?>
