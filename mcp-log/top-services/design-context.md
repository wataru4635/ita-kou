# top-services design-context（XD）
出典: top-services PC 1440×1012 / SP 375×1020。bg navy #003894・文字白。ボタン=グレー版(#ccc/#231815)。
## PC（content 1322・左padding約117/右0=画像は右端まで）
- 左(50%): 業務内容55px Bold白 / SERVICES 36px Light白 / リード「しっかりとした工程管理の元、/高精度、高品質を実現する加工技術。」36px Bold白 lh54 / 本文14px Medium白 lh27 / グレーボタン(278×62)。
- 右(50%): _01(328×410・aspect328/410・上・右寄せ) と _02(657×433・aspect657/433・下・全幅) を右寄せで重ね（_02 が _01 下に約121px 重なる）。両画像右端=section右端(bleed)。
## SP（375）
- 上: 画像 _01(169×211 上右・右bleed) + _02(338×223 下・右bleed) staggered。navy bg は rel-y33から（_01 上部は bg 外）。
- 下: 業務内容34px / SERVICES13px / リード18px Bold lh27 / 本文12px Medium lh22 / グレーボタン(196×43)。
## 実装方針（高圧フランジ products 準拠）
- inner: max-width500/md1440・padding-left var(--padding-inline)→lg rem(120)・padding-right 0・flex column-reverse→md row。
- body(左/SP下): padding-right(SP var / md rem60)。images(右/SP上): width 50%(md)。
- img--top(_01): width 45%(SP)/50%(md)・margin-left auto。 img--bottom(_02): width 90%(SP)/100%(md)・margin-left auto・margin-top 負(重ね)。
- 画像 _01/_02 は _sp 無し→共通。aspect-ratio で比率維持。ボタンは共通 .button--gray。
