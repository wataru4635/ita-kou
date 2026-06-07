<?php
// ==========================================================================
// 定義
// ==========================================================================
/* ---------- パスの短縮 ---------- */
define('IMAGEPATH',            get_template_directory_uri() . '/assets/images');

/* ---------- 各ページのリンク ---------- */
define('HOME_URL',             esc_url(home_url('/')));                          // トップページ
define('SERVICES_URL',         esc_url(home_url('/services/')));                 // 業務内容
define('FACILITIES_URL',       esc_url(home_url('/facilities/')));               // 設備紹介
define('COMPANY_URL',          esc_url(home_url('/company/')));                  // 会社情報
define('RECRUITMENT_URL',      esc_url(home_url('/recruitment/')));              // 採用情報
define('CONTACT_URL',          esc_url(home_url('/contact/')));                  // お問い合わせ
define('CONTACT_CONFIRM_URL',  esc_url(home_url('/contact-confirm/')));          // お問い合わせ確認
define('CONTACT_THANKS_URL',   esc_url(home_url('/contact-thanks/')));           // お問い合わせ完了
define('PRIVACY_POLICY_URL',   esc_url(home_url('/privacy-policy/')));           // プライバシーポリシー

/* ---------- メール設定 ---------- */
define('ADMIN_CONTACT_EMAIL',  'itaoka-kousakusyo@mbh.nifty.com');   // 管理者受信用メールアドレス
define('REPLY_EMAIL',          'itaoka-kousakusyo@mbh.nifty.com');   // 自動返信送信元メールアドレス
define('SITE_NAME',            '有限会社 板岡工作所');             // サイト名（送信者名／メールタイトル等で利用）
