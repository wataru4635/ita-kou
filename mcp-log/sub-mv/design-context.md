# sub-mv design-context（下層共通MV／services）
出典: xd-file/sub-mv/services PC 1440×898 / SP 375×585。下層ページ共通＝components/_sub-mv.scss、差異は modifier。
## 構成
- 上: 白い見出し帯。SERVICES(navy #003894 Bold) + 業務内容(黒 Bold、下)。左寄せ。
- 下: 全幅MV画像。**比率そのまま(width100%/height auto・トリミング無)**。PC=services-mv.webp(2880×1093→1440×546) / SP=services-mv_sp.webp(750×668→375×334)。picture出し分け。
## 値
| | PC | SP |
|---|---|---|
| SERVICES | 69.27px navy lh1.2 | 37px |
| 業務内容 | 22px 黒 | 20px |
| 見出し左 | 約147px | 約34px |
| SERVICES top | 187 | 134 |
| 業務内容 top | 285 | 191 |
| 見出し帯高 | 351 | 251 |
| 画像 | 1440×546(自然比) | 375×334(自然比) |
## 実装
- section.sub-mv(白bg) > div.sub-mv__head(padding-top187/34=ヘッダー分含む・padding-inline147/34) > h1.sub-mv__title(span.__title-en SERVICES + span.__title-ja 業務内容) ／ div.sub-mv__image>picture>img(width100%/height auto)。
- テキスト/画像はページ毎に差し替え（マークアップは各page-*.phpに記述、SCSSは共通）。
- ※ヘッダー(absolute・白)が白帯に重なり不可視→下層用にヘッダー暗色variant(.header--sub: logo-black＋暗色nav)を別途付与。
