# footer layer-analysis（工程2）

## 基本
- PC: グループ556 / 1440×166.1 / bg rect #333333
- SP: グループ179 / 375×517.44 / bg rect #333333

## HTML 変換マッピング（PC/SP 共通の1マークアップ＋CSS出し分け）
| XD | HTML |
|---|---|
| bg rect | `footer.footer`（bg #333）|
| ロゴ群（552/171）| `.footer__logo > a > img`（logo.svg 白）|
| 会社情報 text（553/174）| `.footer__info`（p 名称 / p 住所 ＋ a.Google Map）|
| 縦罫線 線94 | `.footer__divider`（PCのみ・白0.3px）|
| ナビ text（PC 1行 / SP 170）| `nav.footer__nav > ul > li.footer__nav-item > a`（TOP/業務/設備/会社/採用）＋ `.footer__nav-arrow`（SP白丸→・CSS）|
| お問い合わせ pill（118/116）| `.footer__contact > a.footer__contact-btn`（text + span.arrow=btn-arrow-blue）|
| トップへ戻る丸（115）| `a.footer__to-top.js-to-top > img`(to-top.svg) ※PC |
| トップへ戻る角（113）| `a.footer__to-top-sp.js-to-top > img`(to-top_sp.svg) ※SP |
| 横罫線 線92/112 | `.footer__bottom` の border-top（白0.3px）|
| プライバシー/Copyright | `.footer__bottom` 内 a / small |

## 出し分けルール
- ナビ: PC=`li:first-child(TOP)` 非表示・矢印非表示・inline 横並び（業務/設備/会社/採用）。SP=5行縦・白丸矢印・行下罫線。
- to-top: PC=丸(to-top.svg) 上段右 / SP=角(to-top_sp.svg) 下段右。u-desktop/u-mobile 相当で出し分け。
- 縦罫線: PC のみ。
- ホバー（お問い合わせ）: md 以上のみ反転（白→navy）。

## 問題レイヤー/注意
- PC ナビは単一 text ノード（"業務内容　　設備紹介　　会社情報　　採用情報"・全角2スペース区切り）→ li 横並びで再現。
- SP ナビ矢印（白丸+白→）は指定 SVG 無し → CSS 描画（border 円＋擬似要素 chevron）。
- ロゴ・ボタン矢印・to-top はユーザー提供 SVG（自作しない）。
- bg #333333 は新規 → `--footer-bg` を追加。

## 画像リスト
- logo.svg / btn-arrow-blue.svg / to-top.svg / to-top_sp.svg（全て配置済み）
