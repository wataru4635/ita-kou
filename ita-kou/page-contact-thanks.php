<?php
/*
* Template Name: お問い合わせ完了
*/

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$is_post  = ($_SERVER['REQUEST_METHOD'] === 'POST');
$nonce_ok = $is_post
  && isset($_POST['contact_confirm_nonce'])
  && wp_verify_nonce($_POST['contact_confirm_nonce'], 'contact_form_confirm');

if (!$nonce_ok) {
  wp_safe_redirect(CONTACT_URL);
  exit;
}

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

// 必須チェック
$valid = $data['氏名'] !== ''
  && $data['フリガナ'] !== ''
  && is_email($data['メールアドレス'])
  && !empty($data['お問い合わせ内容']);

// スパム対策: 詳細に入力があるのに日本語が含まれない場合は弾く
if (
  $valid
  && $data['ご相談内容の詳細'] !== ''
  && ! preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $data['ご相談内容の詳細'])
) {
  $valid = false;
}

if (!$valid) {
  wp_safe_redirect(CONTACT_URL);
  exit;
}

// メール送信
itaoka_send_admin_email($data, ADMIN_CONTACT_EMAIL, SITE_NAME, FROM_EMAIL);
itaoka_send_auto_reply ($data, FROM_EMAIL,          SITE_NAME, ADMIN_CONTACT_EMAIL);

// セッションをクリア（再送信防止・個人情報保持の最小化）
unset($_SESSION['contact_data']);

/** メール本文の項目ブロックを整形 */
function itaoka_build_inquiry_body($data) {
  $body = "";
  if (!empty($data['お問い合わせ内容'])) {
    $body .= "■お問い合わせ内容\n" . implode("\n", array_map(fn($v) => "・{$v}", $data['お問い合わせ内容'])) . "\n\n";
  }
  if ($data['会社名'] !== '')   $body .= "■会社名\n"   . $data['会社名']   . "\n\n";
  $body .= "■氏名\n"            . $data['氏名']         . "\n\n";
  $body .= "■フリガナ\n"        . $data['フリガナ']     . "\n\n";
  $body .= "■メールアドレス\n"  . $data['メールアドレス'] . "\n\n";
  if ($data['電話番号'] !== '') $body .= "■電話番号\n" . $data['電話番号'] . "\n\n";
  if ($data['郵便番号'] !== '' || $data['住所'] !== '' || $data['建物名'] !== '') {
    $body .= "■住所\n";
    if ($data['郵便番号'] !== '') $body .= "〒{$data['郵便番号']}\n";
    if ($data['住所'] !== '')     $body .= $data['住所'] . "\n";
    if ($data['建物名'] !== '')   $body .= $data['建物名'] . "\n";
    $body .= "\n";
  }
  if ($data['ご相談内容の詳細'] !== '') $body .= "■ご相談内容の詳細\n" . $data['ご相談内容の詳細'] . "\n\n";
  return $body;
}

/** 管理者宛メール */
function itaoka_send_admin_email($data, $admin_email, $site_name, $from_email) {
  $subject  = wp_strip_all_tags('【' . $site_name . '】ホームページよりお問い合わせがありました。');
  $message  = "※本メールはシステムからの自動配信メールです。\n\n";
  $message .= "以下の内容でお問い合わせがありました。\n\n";
  $message .= "ーー お問い合わせ内容 ーー\n\n";
  $message .= itaoka_build_inquiry_body($data);
  $message .= "--------------------------------------\n";
  $message .= "送信日時：" . wp_date("Y/m/d H:i") . "\n";
  $message .= "IPアドレス：" . sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '') . "\n";
  $message .= "--------------------------------------";
  $headers = [
    'From: ' . $site_name . ' <' . sanitize_email($from_email) . '>',
    'Reply-To: ' . sanitize_email($data['メールアドレス']),
  ];
  wp_mail($admin_email, $subject, $message, $headers);
}

/** お客様宛 自動返信メール */
function itaoka_send_auto_reply($data, $from_email, $site_name, $reply_to_email) {
  $subject  = wp_strip_all_tags('【' . $site_name . '】お問い合わせありがとうございます。');
  $message  = $data['氏名'] . " 様\n\n";
  $message .= "※本メールはシステムからの自動配信メールです。こちらのメールアドレス宛にはご返信いただけませんので、ご了承ください。\n\n";
  $message .= "お問い合わせありがとうございます。\n";
  $message .= "以下の内容で受付しました。\n\n";
  $message .= "ーー お問い合わせ内容 ーー\n\n";
  $message .= itaoka_build_inquiry_body($data);
  $message .= "内容確認後、担当者よりご返答いたします。\n";
  $message .= "数日経っても返答がない場合は、サーバの不具合等も考えられますので、お手数ですがお電話にて再度お問い合わせください。\n\n";
  $message .= "==========================\n";
  $message .= "{$site_name}\n";
  $message .= "〒651-2114 兵庫県神戸市西区今寺36-11\n";
  $message .= "TEL: 078-975-2023　FAX: 078-975-3063\n";
  $message .= "Email: " . ADMIN_CONTACT_EMAIL . "\n";
  $message .= "URL: " . esc_url(home_url()) . "\n";
  $message .= "==========================\n";
  $headers = [
    'From: ' . $site_name . ' <' . sanitize_email($from_email) . '>',
    'Reply-To: ' . sanitize_email($reply_to_email),
  ];
  wp_mail(sanitize_email($data['メールアドレス']), $subject, $message, $headers);
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

  <section class="contact-thanks">
    <div class="contact-thanks__inner">
      <h2 class="contact-thanks__title">お問い合わせが完了しました。</h2>
      <p class="contact-thanks__text">この度は、お問い合わせいただき誠にありがとうございます。<br>自動返信メールをお送りいたしました。<br>改めて担当者よりご連絡いたしますので、よろしくお願いいたします。</p>
      <p class="contact-thanks__name">有限会社 板岡工作所</p>
      <div class="contact-thanks__btn">
        <a href="<?php echo HOME_URL; ?>" class="button">
          <span class="button__label">TOPへ戻る</span>
          <span class="button__arrow" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
