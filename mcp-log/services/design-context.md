# services コンテンツ design-context（XD）
出典: PC 1440×2957 / SP 375×2646。白bg。4行（画像＋テキスト）交互。
## 行（PC: 画像50vw 端に密着・幅で拡大 / テキストは中央寄せインナーで実質固定[ギャップ一定]）
- 行1 SERVICES01 精密切削加工（画像左）/ 行2 SERVICES02 モータ部品加工（画像右）/ 行3 SERVICES03 幅広い分野への対応力（画像左）/ 行4 SERVICES04 一貫対応と柔軟な対応力、そして徹底した品質管理（画像右・見出し2行）。
- 配色: SERVICES0X=navy 22px(PC)/14px(SP) Bold。見出し=navy 36px(PC)/18px(SP) Bold。本文=黒 14px lh27(PC)/12px lh22(SP) Medium。
## PC値（1440）
- 画像枠 720.96×540.56（aspect 1.3337・object-fit cover）。画像は外端に密着、width 50vw（幅で拡大）。
- テキスト幅519、画像との間隔約82px(一定)、外端から約120px。テキスト=画像の高さに対し縦中央付近。
- label→見出し ~20 / 見出し→本文 ~17。行間（画像下〜次画像上）約170。先頭行 上から163（section padding-top）、最終行下 padding-bottom約114。
## SP値（375）
- 画像はインセット（content幅約317・左右padding約29）、画像→ラベル ~32、label→見出し ~6、見出し→本文 ~17。行は自然高さで縦積み。
## 実装
- section.services（白bg・overflow hidden[bleed対策]・padding-block 163/114 PC）> .service（行）×4。
- .service: SP=block（画像→.__body 縦積み・padding-inline約29）。PC(md)=flex align-items center, --reverse で画像右。.__image width:50vw flush。.__body flex:1 + .__body-inner max-width519、画像側に padding(82)、justify start/end。
- .__image img: aspect-ratio SP 316.8/239.63・PC 720.96/540.56・object-fit cover・width100%。画像 services_01-04（_sp無し=共通）。
- 本文の \n は <br>（行数=設計高さ維持）。row4見出しは<br>2行。
