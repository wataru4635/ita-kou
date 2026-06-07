# company-profile 計画
出典: PC 1440×545 / SP 375×826。白bg。見出し「会社概要」navy PC36px/SP18px。
## 表（用語＋説明・極細罫線 #000 0.25px→#ccc 1px 近似）
- 行: 会社名/有限会社 板岡工作所 ・ 代表者/代表取締役　板岡 博史 ・ 住所/本社…工場…(複数行) ・ 設立/平成12年12月 ・ 資本金/300万円 ・ 事業内容/機械部品加工 ・ 主な取引先/・西芝…(4行)
- term/desc=14px(PC)/12px(SP) Medium黒。term左・desc右(inline)。
## レイアウト
- PC: 2カラム（左=会社名/代表者/住所、右=設立/資本金/事業内容/主な取引先）。column-gap 74。行罫線を両カラムで揃える→subgrid・行トラック 82/82/81/125。住所は2トラックspan(本社/工場)。term幅~135・desc inset左134/右149。
- SP: 1カラム7行縦積み（左dl→右dl の順＝会社名…主な取引先）。term幅~69。各行 border-top。
- inner: max-width rem(1262)(1202+60)/SP rem(500)・padding var。section padding ~50/43、heading→table ~18。
- 住所 \n→<br>・\n\n→<br><br>。主な取引先 \n→<br>。
