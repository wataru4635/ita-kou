# 共通ボタン design-context（XD 抽出値）

> 出典: `xd-file/btn/` export_0001(PC 278×62), 0002(SP 191×42), 0003(グレー 278×62)
> 共通コンポーネント（`components/_button.scss`）。project-env 10-1: **見た目のみ・余白(margin)は持たせない**。

## バリエーション
| 種別 | 背景 | 文字/矢印 | 変数 |
|---|---|---|---|
| 既定（navy） | #003894 | #FFFFFF | bg `--main-navy` / 文字 `--white` |
| `--gray` modifier | #CCCCCC | #231815 | bg `--gray` / 文字 `--ink` |

## サイズ・テキスト
| | PC(0001/0003) | SP(0002) |
|---|---|---|
| ボタン | 277.69 × 61.09 | 190.65 × 41.94 |
| 角丸 | なし（直角・cornerRadii無し） | なし |
| 文字「詳しく見る」 | Noto Sans JP 18px Bold ls140(0.14em) 中央 | 12.36px Bold ls0.14em 中央 |
| く字矢印 `>` (bbox) | 12.29 × 24.58（box L≈17.38）右端から約25.6px | 8.44 × 16.88（box L≈11.94）右端から約17.6px |
| 矢印 stroke | 0.9px（PC/グレー） | 0.62px |

※ SP は PC の約0.687倍（278→191 / 18→12.36 / 24.58→16.88）。

## く字矢印（border で作成・指定）
- 正方形ボックス（border-top + border-right）を `rotate(45deg)` → `>`。
- box L=高さ÷√2。PC: 24.58/√2≈17.38 → rem(17)。SP: 16.88/√2≈11.94 → rem(12)。
- border幅 ~1px（design 0.9/0.62）。色は `currentColor`（文字色に追従＝反転時も自動で合う）。
- 右端から PC≈25.6 / SP≈17.6px、上下中央。

## ホバー（色反転・「いい感じ」）
- 既定(navy): bg→`--white` / 文字・矢印→`--main-navy`（border は navy のまま＝白ボタンに navy 枠・navy矢印）。レイアウトシフト防止のため border は常時 `1px solid`（既定は bg と同色で不可視）。
- `--gray`: bg→`--ink`(#231815) / 文字・矢印→`--white`（border→ink）。
- transition `var(--duration-base)`。`@media (any-hover:hover)` 内。

## 幅の挙動（ユーザー要望）
- 文字数が少なくても（〜6文字程度）**同じ幅を維持** → `min-width`（SP191 / PC278）。
- 長文（10文字など）でも**枠からはみ出さない** → `display:inline-flex` + `max-width:100%` + 左右 padding でボタンが内容に応じて伸長し、文字は常にボタン内に収まる（`min-height` で折返し時も潰れない）。
- 実測: 5文字=278 / 6文字=278（同一）/ 10文字=308（伸長・はみ出しなし）。

## HTML（使用例・余白は使用側で付与）
```html
<a href="{URL}" class="button">
  <span class="button__label">詳しく見る</span>
  <span class="button__arrow" aria-hidden="true"></span>
</a>
<!-- グレー -->
<a href="{URL}" class="button button--gray"> … </a>
```
