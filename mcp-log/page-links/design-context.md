# page-links design-context（XD）
出典: PC 1440×455 / SP 375×484。section bg #333333(=footer-bg・下のfooterと同色で連続)。
## カード（2枚: 会社情報COMPANY / 採用情報RECRUITMENT）
- 各カード: 背景画像(common/page-links-company-bg.webp, page-links-recruitment-bg.webp ※_sp無し=共通)。**オーバーレイは画像に焼込済→疑似要素不要**。
- カード内中央: 見出し(白Bold)＋en(白Light)＋navyボタン(共通.button)。**カード全体が<a>リンク**（ボタンはspan）。
- 配色: 見出し/en/ボタン文字=白、ボタン地=navy #003894。
## PC（1440×455）
- 2カード横並び。各 約699×425（aspect 699/425）、gap14、section左右padding14・上下15。
- 会社情報 41.19px Bold center / COMPANY 25px Light / navyボタン278×62。ボタンはCOMPANYの約43px下。
## SP（375×484）
- 2カード縦積み。各 315×192（同aspect）、gap12、section padding 上68/下20・左右30(→var)。
- 会社情報 28.28px Bold / COMPANY 12px Light / navyボタン196×42(SPサイズ)。
## 実装
- section bg footer-bg。list flex column(SP)→row(md)・gap12/14・max-width・padding。
- item flex:1。card: position relative・aspect-ratio 699/425・flex column center・overflow hidden。bg img absolute cover。content z1 中央。
- ボタンは <span class="button">（カードが<a>のため）。hover: 画像 scale(1.05)＋ボタン反転（.page-links__card:hover .button）。
- URL: 会社情報→COMPANY_URL / 採用情報→RECRUITMENT_URL。
