# 規約遵守ルール（毎ターン確認）

実装裁量を阻害せず、規約系のみを毎ターン強化するための最小限ルール集。
hook で毎ターン注入される想定。

---

## ⚠️ 環境固有の規約は docs/project-env.md を最優先

**プロジェクトごとに異なる規約 (CSS設計 / 命名 / SCSS関数 / mixin / ディレクトリ構造)** は本ファイルでは強制しない。
必ず `docs/project-env.md` を読んで該当プロジェクトの規約を確認すること。
project-env.md と本ファイル「標準値」が矛盾する場合は **project-env.md を優先**。
project-env.md が存在する場合は必ず読み込むこと。

### 標準値 (新規プロジェクト用の参考デフォルト・override 可)

- **CSS設計**: FLOCSS (`.l-/.p-/.c-/.u-` レイヤー prefix)
- **命名**: BEM (`__element` / `--modifier`、camelCase 要素名)
- **SCSS数値**: `rem()` 関数で囲む (関数が無い環境では px 直書き OK)
- **レスポンシブ**: `@include mq("md")` (mixin が無い環境では `@media` 直書き OK)
- **shorthand**: `padding-block/-inline` 個別指定推奨
- **カラー**: 変数化 (`_variables.scss` に追加)

⚠️ 上記は「教育的標準」。**生徒の既存案件の規約は決して上書きしないこと。**
コーディング前に必ず project-env.md または既存 src/ を確認 → 既存規約に合わせる。

---

## mcp-log 保存先（必須・環境非依存）

工程ごとに保存先が決まっている：

| 工程 | ファイル名 |
|---|---|
| 工程0 tokens | `mcp-log/{page}/variables.md` |
| 工程2 scan | `mcp-log/{page}/{section}-layer-analysis.md` |
| 工程3 blueprint | `mcp-log/{page}/{section}-plan.md` |
| 工程6 pixeldiff | `mcp-log/{page}/pixeldiff.md` |

書き込み前に `mkdir -p mcp-log/{page}` を実行する。

---

## サブエージェント隔離（必須・環境非依存）

Figma MCP の以下のツールは **必ず Task ツール経由（サブエージェント経由）で実行**:
- `mcp__figma__get_design_context`
- `mcp__figma__get_metadata`
- `mcp__figma__get_screenshot`

メインエージェントが直接呼ぶのは禁止。サブエージェントが結果を mcp-log に保存し、メインはファイルを Read で読む。

---

## MCP ツールの必須呼び出し (各工程開始時)

各工程で以下の MCP ツールを呼ばずに「完了」報告は禁止。詳細手順は MCP 経由でのみ取得可能。

| 工程 | 必須 MCP ツール (mode="xd") |
|---|---|
| scan | `auto_coding_scan` |
| blueprint | `auto_coding_blueprint` |
| review | `auto_coding_review` |
| pixeldiff | `auto_coding_pixeldiff` |
| rca | `auto_coding_rca` |

各 skill (`/scan` `/blueprint` `/review` `/pixeldiff` `/rca`) のスタブは「絶対命令」として上記 MCP 呼び出しを必須化している。スタブを読んだだけで「実行した」と判断するのは禁止。必ず MCP 応答プロンプトの全手順を実行すること。

---

## 環境変数

- Figma access token: `.env` の `FIGMA_ACCESS_TOKEN`
- 画像取得は REST API + 上記トークン

---

## 注: このファイルに含めない（実装裁量に任せる）

以下は **実装の文脈で判断** すべきため、毎ターン注入しない：

- Figma 値の厳密な再現方針（過剰に厳密だと実装が破綻する場合あり）
- 複雑な SVG / マスク・装飾レイヤーの取り扱い判断
- セクション固有のレスポンシブ戦略

これらは PIPELINE.md / CODING_RULES.md / agent.md / patterns/ に書かれているので、必要に応じて読む。
