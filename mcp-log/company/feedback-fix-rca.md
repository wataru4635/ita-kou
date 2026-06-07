# company-profile / history フィードバック修正 RCA＋対応（2026-06-06）

## [1] profile: 行高固定で将来溢れる
- 原因: grid-template-rows を固定px(82/82/81/125)で指定 → 内容増でトラックを超え溢れる。
- 対応: minmax(rem(min), auto) ＋ grid-auto-rows: minmax(rem(82),auto)。最小高さ＝デザイン値を維持しつつ内容で伸長。
- 検証: 取引先に3行追加注入→行125→195に伸び・住所セルも追従(206→276)・溢れ0・横スクロール0・subgrid整列維持。現状 pixeldiff 96.98%（不変）。

## [2][4] 住所: 本社/工場の区切り線欠落＋構造未分割
- 原因: デザインの極細罫線(#000 0.25px=線49)を「視認不可」と独断で省略し、住所を1テキスト＋全角スペースのインデントで実装した（誤判断）。設計はラベル｜詳細＋区切り線の構造。
- 対応: dd を .profile-address に再構築。本社/工場を [ラベル左｜詳細右(〒/TEL 2行)] とし、2行目に border-top(var(--gray)) の区切り線。PC/SP共通。
- 検証: PC 本社254｜〒296・工場行に#ccc罫線・列揃い。SP 本社/工場分割＋罫線。pixeldiff PC 96.98% / SP 92.60%（89.4→改善）。

## [3] history(PC): 内容増で詰まる
- 原因: min-height:82 ＋ padding-block:0。内容が82超で上下余白が消える。
- 対応: padding-block: rem(16) 追加（min-height82は維持・border-box）。現状は82のまま不変、内容増時のみ伸長＋余白維持。
- 検証: 5行注入→行133に伸び・上下余白17/16維持・溢れ0。現状 pixeldiff 97.01%（不変）。

## [5] history(SP): 変更なし＝OK
- md のみ padding 変更。SP(base padding-block25)は不変。section527・配置同一・overflowX0 確認。

## ルール追記
- docs/CODING_RULES.md「6.4 行が増減する表・リストの行高」を追加（height固定禁止／min-height＋padding-block／Gridは minmax(min,auto)＋grid-auto-rows）。

## 追加対応（2026-06-06 その2）: profile 複数行セルの下余白
- 依頼: 会社概要も他と同様、複数行になった時に少し下余白を付ける。
- 対応: .profile-row md の padding-bottom を 0→rem(16)（padding-block: rem(28) rem(16) / --address・--clients は rem(18) rem(16)）。トラックは minmax のため短い行は82のまま、複数行セルのみ下余白付きで伸長。
- 検証: 主な取引先 下余白 7→17px・行125→136、住所セルも追従217、短い行82維持、section556、overflowX0。SPは元々padding-block20で下余白あり（変更なし）。pixeldiff PC 96.97%。
- ルール: project-env.md 10-14 ／ CODING_RULES.md 6.4 に明記（両ファイル）。
