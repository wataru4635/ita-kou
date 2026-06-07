# privacy-policy content pixeldiff
- PC: 94.49% / NCC 0.225（1440×1248）
- SP: 88.41% / NCC 0.2004（375×1097）
## 実装（セマンティック分割：デザインは1テキストだが見出し＋本文＋リストに分割）
- リード<p> → 1〜5各ブロック(<div.privacy__block> > <h2>＋<p>＋必要なら<ul>) → 【お問合せ窓口】ブロック(<h2>＋連絡先<p>) → 締め<p>。
- 見出し（番号1〜5・【お問合せ窓口】）= Bold、本文/リスト = Medium。PC14px lh26 / SP12px lh20。色#000。※PNG確認で見出し太字（JSONは1ノード）。
- □リスト = <ul><li>、li を flex＋::before content"□"（折返し時もテキスト揃え）。
- inner max-width rem(1058)(998+60) 中央／SP rem(500)・padding var。
## 実測
- PC: lead top95/left221・innerW1058・h2 700/本文500・section1218≒1248。SP: lead top22/left24・section1090≒1097。overflowX 全0。
## 残差: 本文の折返し差＋見出し太字AA＋空行リズムの微差。

## フィードバック修正（2026-06-07）: お問合せ窓口のタイトル下余白
- 原因: 番号見出し(1.〜5.)は「見出し\n本文」で連続のため .privacy__heading+.privacy__text を margin-top:0 で全体適用。だが【お問合せ窓口】だけは「見出し\n\n本文」=空行1つ入る構造で、そこも連続になっていた。
- 対応: .privacy__block--contact .privacy__text に margin-top rem(20)/md rem(26)（空行1つ分）を付与。番号見出しは0のまま。
- 検証: PC タイトル→本文 26px・SP 20px（番号見出しは0維持）・overflowX0。スクショ確認済み。
