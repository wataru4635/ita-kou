# privacy-policy sub-mv pixeldiff（共通 .sub-mv 再利用・画像なし）
- PC: 81.19%（1440×351・ヘッダー込み）
- SP: 92.40%（375×242）
## 配置/検証（実測）
- 画像なし（他サブMVと違い .sub-mv__image を持たない）。見出しのみ。
- EN「PRIVACY POLICY」69.27px/SP37px・色 #03518F（--privacy-blue・コンプ準拠）。JA「プライバシーポリシー」22px/SP20px 黒。
- PC: EN top187/left147・JA285・section350≒351。SP: EN top134/left34・JA191・section250≒242。黒ロゴ・overflowX 全0。
## 申し送り（要確認）
- 見出しEN色 #03518F はコンプ準拠だが、他サブMV（COMPANY等）は #003894（--main-navy）。privacy だけ別青。サイト統一したい場合は --main-navy に変更可。
- SP は共通 .sub-mv__head の padding(134/34)を流用したためコンプ(127/28)比 +約7px。気になる場合は modifier で調整可。
## 残差: PCはXD部品PNGに無いサイトヘッダー帯。
