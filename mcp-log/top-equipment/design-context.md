# top-equipment design-context（XD）
出典: PC 1440×971 / SP 375×845。bg=top-equipment-bg[_sp]（透明度焼込→CSS opacity無）。機械画像=top-equipment[_sp]（2台を1枚に書出）。
## 色（JSON）
- 設備紹介: navy #003894。EQUIPMENT/リード/本文: 黒 #000。ボタン: navy(#003894)＋白文字（共通 .button）。
## PC（content 機械587×768左 / テキスト577右）
- 機械画像 rel(64,113) 587×768（aspect 587/768）。
- テキスト rel-x744: 設備紹介55px(rel-y177) / EQUIPMENT36px Light(254) / リード「技術と最新設備の融合で安定した/品質と高い生産性を実現。」36px Bold lh54(391) / 本文14px Medium lh27(531) / navyボタン278×62(799)。
- 機械は見出しより約63px上から。
## SP（375）
- 見出し「設備紹介」34px navy(rel-y70) + EQUIPMENT13px(128) → 機械画像 top-equipment_sp 323×265(rel-y159) → リード18px Bold lh27(447) → 本文12px Medium lh22(520) → navyボタン196×43(754)。
- ※SP見出しはXDでは「技術/設備紹介」だが「設備紹介」に統一（EQUIPMENT＝設備紹介）。
## 実装
- section relative・白bg・overflow hidden。bg picture(PC/SP)・cover・opacity無。
- inner: SP block(DOM順: head→machines→body) / md grid: columns 587fr 577fr・column-gap rem(92)・areas "machines head"/"machines body"・rows auto 1fr。head に md padding-top63（機械上端より下げ）。
- 機械 picture(PC top-equipment.webp / SP top-equipment_sp.webp)。ボタン共通 .button（navy）。本文 \n は <br>。
