# mv layer-analysis（工程2）

## 基本
- PC: グループ543 / 1440×900。SP: グループ548 / 375×667。

## レイヤー構造
```
section.mv（全画面）
├ mv_01 rect（fill image）＝スライダー画像  ← swiper 3枚に展開
├ 長方形165 rect #000 opacity0.35           ＝黒オーバーレイ
├ グループ540（コピー）
│ ├ グループ107/106: パス64-82（白ベクター）＝縦書きキャッチ「精度に妥協しない。/選ばれるものづくり。」
│ └ text「Precision without compromise.　…　Manufacturing that earns trust.」25px Medium 白
└ グループ542: 楕円16/17/18（8px）＝ページネーション3点（17番=#FCEE21 アクティブ）
（スクロールダウンは XD 無し → 高圧フランジ準拠で追加）
```

## HTML 変換マッピング
| XD | HTML |
|---|---|
| mv_01 画像 | `.swiper-wrapper > .swiper-slide > picture > img`（×3・PC/SP出し分け）|
| 黒オーバーレイ | `.mv__slider::after`（rgba(0,0,0,.35)）|
| 縦書きキャッチ（ベクター） | `p.mv__catch`（writing-mode: vertical-rl・Noto Sans JP Bold）|
| 英字 text | `p.mv__en--left` / `p.mv__en--right`（PC横）/ SP は縦書き |
| ページネーション 3点 | `.swiper-pagination.js-mv-pagination`（bullet active=黄）|
| スクロールダウン | `p.mv__scroll`（高圧フランジ `.scroll-down` 準拠）|

## 問題レイヤー/注意
- キャッチ=ベクターパス（アウトライン）→ CSS縦書きテキストで近似（字形完全一致せず）。
- Swiper fade: `.swiper`/`.swiper-slide` を height100%・画像 object-fit:cover。
- ページネーションはオーバーレイ上（z2）に出すため `.swiper`外（`.mv`直下）に配置し `el` 指定。
- 黒オーバーレイは pagination/コピーより下（z1）。

## 画像リスト（配置済み）
- top/mv_01.webp ・ mv_01_sp.webp（slide1）/ mv_02(_sp) / mv_03(_sp)

## Swiper / JS
- init は `_vite/src/js/top.js`（新規・swiper-bundle のグローバル Swiper 使用）。setup.php で front-page に top.js（swiper-js 依存）enqueue 済み。
