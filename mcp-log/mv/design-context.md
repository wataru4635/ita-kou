# MV design-context（XD 抽出値）

> 出典: `xd-file/mv/export_0001.json`(PC 1440×900 / グループ543), `export_0003.json`(SP 375×667 / グループ548)
> 参考: 高圧フランジ MV（Swiper fade スライダー・スクロールダウン）。画像は `assets/images/top/` の3枚（PC+SP）。

## 構成（全画面スライダー）
- 全画面（PC 100vw×100vh / SP 100dvh）の背景スライダー（3枚・fade）。
- 各スライド画像の上に **黒オーバーレイ #000 opacity 0.35**（テキスト可読性）。
- 縦書きキャッチ（白・中央）／英字（白）／ページネーション（左下・3点・アクティブ黄）／スクロールダウン（右下）。

## 配色
| 用途 | 値 |
|---|---|
| オーバーレイ | `#000` opacity 0.35 |
| テキスト（キャッチ・英字・scroll） | `#FFFFFF` |
| ページネーション アクティブ | `#FCEE21`（新規 `--accent-yellow`）/ 非アクティブ 白 |

## 画像（スライダー3枚・picture でPC/SP出し分け）
| slide | PC | SP |
|---|---|---|
| 1 | top/mv_01.webp | top/mv_01_sp.webp |
| 2 | top/mv_02.webp | top/mv_02_sp.webp |
| 3 | top/mv_03.webp | top/mv_03_sp.webp |
- object-fit: cover で全画面。SP は `<source media="(max-width:767px)">`。

## PC（1440×900）座標（rel）
| 要素 | 値 |
|---|---|
| 背景画像 | full 1440×900・cover |
| 黒オーバーレイ | full・#000 0.35 |
| キャッチ（縦書き・白・ベクター由来） | 「精度に妥協しない。」(右列)／「選ばれるものづくり。」(左列)。group rel-x 652.5〜785（中央・viewport中心720）, rel-y 254.9〜783.5（縦中心≈519）。文字 ≈52px Bold。writing-mode: vertical-rl |
| 英字（横・白） | 「Precision without compromise.」(左)＋「Manufacturing that earns trust.」(右)。Noto Sans JP 25px Medium ls0.02em。node rel-x 224〜1226(幅1002・中央), rel-y 449.4（中心≈467）。中央にキャッチ分の空き |
| ページネーション | 3点 各8.07px・rel-x 73.8/96.9/120.1・rel-y 861.9（下端〜38px）。2番目=黄(#FCEE21)・他白。clickable |
| スクロールダウン | 右下（高圧フランジ準拠: bottom60/right30）縦書き"SCROLL"＋アニメ縦線 白 |

## SP（375×667）
| 要素 | 値 |
|---|---|
| 背景画像 | mv_0X_sp.webp・cover |
| 黒オーバーレイ | #000 0.35 |
| キャッチ（縦書き白） | 同テキスト・中央寄り右・文字 ≈30px Bold（PC比縮小・要pixeldiff調整） |
| 英字（縦書き白） | 「Precision without compromise.」「Manufacturing that earns trust.」15px Medium・キャッチ左に縦書き2列 |
| ページネーション | 左下3点・アクティブ黄 |
| スクロールダウン | 右下（同・サイズ調整可）|

## Swiper 設定（高圧フランジ準拠・最新CDN）
- `loop:true, speed:2000, effect:"fade", fadeEffect:{crossFade:true}, autoplay:{delay:4000, disableOnInteraction:false}, pagination:{el, clickable:true}`
- CDN: 最新（swiper@12 / setup.php で front-page に enqueue 済み）。init は `top.js`（新規・swiper-js 依存）。

## スクロールダウン（高圧フランジ `_scroll-down.scss` 準拠）
- `position:absolute; bottom:60px; right:30px; writing-mode:vertical-rl; text-transform:uppercase; color:#fff; font-size:rem(16);`
- `::after` 縦線 1px×rem(70) 白・`@keyframes scroll-down 2s infinite`（scale 縦アニメ）。

## 注意
- キャッチは XD ではベクターパス（アウトライン文字）。CSS の縦書きテキスト（Noto Sans JP Bold・vertical-rl）で近似（字形は完全一致しない）。
- ヘッダー（position:absolute）が MV 上部に重なる（白ロゴが MV 上で視認可能に）。
- `--accent-yellow:#FCEE21` を新規追加。
