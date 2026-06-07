"use strict";

/* ===============================================
# お問い合わせフォーム バリデーション
# - 必須: お問い合わせ内容(1つ以上) / 氏名 / フリガナ / メール / 同意
# - メール形式チェック
# - ご相談内容の詳細: 入力があるのに日本語が無い場合はスパムとして弾く
# サーバー側(confirm/thanks)でも再検証する。本JSはUX用。
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contact-form");
  if (!form) return;

  const setError = (el, on) => {
    if (el) el.classList.toggle("is-error", on);
  };

  form.addEventListener("submit", (e) => {
    let valid = true;
    let firstError = null;
    const markInvalid = (el) => {
      valid = false;
      if (!firstError) firstError = el;
    };

    // お問い合わせ内容（1つ以上）
    const typeItem = form.querySelector(".contact-form__item--type");
    const typeChecked =
      form.querySelectorAll('input[name="お問い合わせ内容[]"]:checked').length > 0;
    setError(typeItem, !typeChecked);
    if (!typeChecked) markInvalid(typeItem.querySelector("input"));

    // 必須テキスト（氏名・フリガナ）
    const checkRequired = (id) => {
      const input = form.querySelector("#" + id);
      const item = input.closest(".contact-form__item");
      const ok = input.value.trim() !== "";
      setError(item, !ok);
      if (!ok) markInvalid(input);
    };
    checkRequired("name");
    checkRequired("furigana");

    // メールアドレス（必須＋形式）
    const email = form.querySelector("#email");
    const emailItem = email.closest(".contact-form__item");
    const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim());
    setError(emailItem, !emailOk);
    if (!emailOk) markInvalid(email);

    // 同意
    const agreeWrap = form.querySelector(".contact-form__agreement");
    const agree = agreeWrap.querySelector('input[name="個人情報同意"]');
    setError(agreeWrap, !agree.checked);
    if (!agree.checked) markInvalid(agree);

    // ご相談内容の詳細：日本語チェック（スパム対策）
    const detail = form.querySelector("#detail");
    if (detail && detail.value.trim() !== "") {
      const hasJapanese = /[぀-ゟ゠-ヿ一-鿿]/.test(detail.value);
      if (!hasJapanese) {
        e.preventDefault();
        alert("「ご相談内容の詳細」は日本語でご記入ください。");
        detail.focus();
        return;
      }
    }

    if (!valid) {
      e.preventDefault();
      if (firstError) firstError.focus({ preventScroll: false });
    }
  });
});
