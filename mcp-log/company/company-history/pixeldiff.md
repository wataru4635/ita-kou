# company-history pixeldiff
- PC: 97.01% / NCC 0.3539（1440×647）✅ ※NCC低は白地＋細字主体・マッチ率が有効
- SP: 91.67% / NCC 0.055（375×521）
## 配置/検証（実測一致）
- 見出し「沿革」navy PC36px top36/SP18px top32。
- 年表5行（年｜月｜出来事・極細罫線#000 0.25px→var(--gray)1px近似）。ペアリングは設計どおり:
  昭和52年/1月/創立, 平成5年/8月/今寺移転, 平成12年/12月/有限会社設立, 平成18年/4月/潤和工場移転, 令和7年/9月/代表交代。
- PC: grid[年85][月87][出来事1fr]・行min-height82・align center。年119/月204/出来事291。section650≒647。
- SP: grid[年62][月36][出来事1fr]・align start・行padding-block25。section527≒521。overflowX 全0。
## 残差: 出来事の折返し差（特にSP行1）＋font AA。
