# 404 ページ 検証ログ

## 概要
- 対象: `404.php` + `_vite/src/sass/module/_not-found.scss`
- 種別: **デザインカンプなしページ**（お問い合わせ完了 / プライバシーポリシー等のトンマナに準拠して作成）
- 構成: `sub-mv`（EN「404」/ JA「ページが見つかりません」）＋ 中央メッセージ（`.not-found`）＋ 共通ボタン `.button`（TOPへ戻る）

## pixeldiff について
XD デザインカンプが存在しないため、ピクセル比較（XD vs 実装）は **該当なし**。
代替として実機ブラウザ（Playwright）で PC/SP を検証し、既存ページとのトンマナ一致を目視確認した。

## 実機検証結果（http://ita-kou.localtest/<存在しないURL>/）

### PC（1440px）
- 横スクロール: 0（scrollWidth - innerWidth = -15、スクロールバー分のみ）
- sub-mv EN「404」/ JA「ページが見つかりません」表示、見出し色 navy `rgb(0,56,148)`
- `.not-found__title` navy・28px、本文・ボタン（TOPへ戻る → HOME_URL）表示
- ヘッダー / フッター 正常表示
- スクショ: `notfound-pc.png`

### SP（375px）
- 横スクロール: 0（-15）
- sub-mv EN 37px / `.not-found__title` 20px / 本文 13px（レスポンシブ値で縮小）
- 本文の PC 専用 `<br class="u-desktop-inline">` が SP で `display:none`（自然折り返し）
- 共通ボタン min-width 191px（375px 内に収まる）
- スクショ: `notfound-sp.png`

## レビュー（工程5 A〜F）
- C（SCSS/HTML規約）: 違反 0 件
- F（レスポンシブ）: 全 `.not-found*` クラスに `@include mq("md")` あり
- D / D-2 / E（XD突合・高さゲート・カンプ比較）: カンプなしのため該当なし
- 判定: OK
