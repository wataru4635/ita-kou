# page-links pixeldiff
- PC: 96.05% / NCC 0.9208（1440×455）✅
- SP: 82.08% / NCC 0.7538（375×484・スクロールバー除去で計測）△
## 調整(RCA)
- PC: カード padding-top89（コンテンツを中央より下げ・設計159px一致）で 88.23→96.05。SPは padding-top24。
## 配置検証（正確）
- PC: section455・カード699×425 x14/727・gap14・タイトル41px・navyボタン中央・overlay焼込（疑似要素なし）・カード全体<a>。
- SP: section493≒484・カード323×196(設計315・padding var26)・y68/276・gap12。overflowX0。
## 残差: SPはカード背景画像のobject-fit coverクロップ差＋カード幅(var26→323 vs 設計30→315)＋font AAが主。配置・配色・overlayは設計一致。
