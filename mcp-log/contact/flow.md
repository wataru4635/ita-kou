# お問い合わせ フロー（確認・完了）実装＆検証（2026-06-07）
機構は reference-projects/サン工房 を参照、確認/完了レイアウトは高圧フランジ参照。
## ページ
- page-contact.php … フォーム（action=CONTACT_CONFIRM_URL・nonce contact_form_submit）。
- page-contact-confirm.php … session保存→確認表示（label/value）＋hidden再送→action=CONTACT_THANKS_URL（nonce contact_form_confirm）。修正する(history.back)/送信する。
- page-contact-thanks.php … nonce検証→必須/email/spam再チェック→wp_mail(管理者＋自動返信)→session破棄→完了表示＋TOPへ戻る。
## 定数（defines.php・ダミー＝本番差し替え）
- ADMIN_CONTACT_EMAIL=info@ix-code.com（sankoubou同様）/ REPLY_EMAIL=info@ix-code.com / SITE_NAME=有限会社 板岡工作所。
## 検証（実機・PC/SP）
- PC: フォーム入力→確認(全項目正しく表示・hidden13)→送信→完了 を通し成功。SP: 確認も label上→値・ボタン縦積み・overflowX0。
- 直アクセス保護: /contact-confirm/・/contact-thanks/ を直開き→/contact/ へリダイレクト ✅。
- バリデーション: 空送信→遷移阻止＋必須5項目(お問い合わせ内容/氏名/フリガナ/メール/同意)エラー表示 ✅。
## 残: wp_mail はローカルでは実送信未確認（コードは正・本番アドレス差し替えで動作）。
