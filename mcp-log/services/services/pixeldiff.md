# services コンテンツ pixeldiff
- PC: 88.83% / NCC 0.8641（1440×2957）
- SP: 72.74% / NCC 0.681（375×2646・スクロールバー除去で計測）
## 配置検証（実測・設計一致）
- PC: 画像 50vw・外端に密着(imgLeft0/imgRight0 交互)・高さ540。テキスト left802/119・幅519・間隔82一定。overflowX0。
- SP: 画像インセット(317×240 中央)・行縦積み。imgTops 69/729/1346/1940 ≒ 設計 69/737/1359/1945。servicesH2652≒2646。overflowX0。
## RCA（SP）
- 初回62.7%: SP padding-top56(設計69)・行間56(設計82)で下方ほど上ズレ累積 → padding-top69・margin-top82 で 72.7% に改善。
- PC: body-inner max-width 519→601（border-boxでpadding82込）でテキスト幅519・位置(802/119)を設計一致に。
## 残差: 写真4枚(services_01-04・object-fit cover)の内容/クロップ・本文の行折返し差・font AA。レイアウトは設計一致。
## 仕様: PC=画像50vw端密着で幅拡大・テキストは中央寄せインナーで間隔一定（位置ほぼ固定）。SP=画像インセット縦積み。
