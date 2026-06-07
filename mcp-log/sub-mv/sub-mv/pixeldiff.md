# sub-mv（services）pixeldiff
- PC: 89.88% / NCC 0.8113（1440×898・サイトヘッダー込み）
- SP: 95.94% / NCC 0.9070（375×585）✅
## 配置検証（実測・設計完全一致）
- PC: SERVICES 69.27px navy top187/left147・業務内容22px top285・画像1440×547(自然比)top350。overflowX0。
- SP: SERVICES37px top134/left34・業務内容20px top191・画像375×334(自然比)top250。overflowX0。
## 注記
- XDの部品PNGはサイトヘッダーを含まないため、PCはヘッダー領域(上約104px)＋画像AAが残差（レイアウトのズレではない）。
- 下層共通: header ロゴを logo-black.svg に出し分け（白帯で可視化）。PCナビはnavyバー・SPハンバーガーはnavyで元々可視。
- 画像は比率そのまま（width100%/height auto、トリミング無）。picture で PC/SP 出し分け。
