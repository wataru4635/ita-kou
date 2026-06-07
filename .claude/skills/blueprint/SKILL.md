---
name: blueprint
description: "工程3の実装計画を作成する。レイヤー分析（工程2）完了後に自動発動する。MCPツール auto_coding_blueprint の呼び出しが必須。"
user-invocable: false
allowed-tools: Read, Grep, Glob, Write, Edit
---

# 工程3: 実装計画

## 🚨 絶対命令 (skip 禁止)

### Step 0a: 環境自動検出 (project-env.md が [未記入] の場合のみ)
`docs/project-env.md` を Read し、セクション5が `[未記入]` なら以下を実行:

1. `reference-projects/` 内のサブディレクトリの SCSS ファイルを Glob で収集 (`**/*.scss`, node_modules/ 除外)
   - `reference-projects/` が空なら、プロジェクト内の既存 SCSS (`src/sass/**/*.scss`, `src/scss/**/*.scss`) を対象にする
2. 記法検出:
   - `@function` 定義を Grep → rem関数名・引数形式・定義パスを記録
   - `@mixin` 定義を Grep → メディアクエリMixin名・ブレークポイント値を記録
   - セレクタを30個収集 → FLOCSS/BEM/命名ケースを判定
   - `@use` / `@import` パターンを判定
   - package.json から Gulp/Vite/webpack を検出
3. `docs/project-env.md` のセクション1〜6を検出結果で上書き

### Step 0b: パターン抽出 (Step 0a とは独立 — patterns-custom/ が空なら必ず実行)
`docs/patterns-custom/` に `.gitkeep` 以外のファイルがなく、かつ `reference-projects/` にプロジェクトがある場合:

1. `reference-projects/` 内の SCSS パーシャル (`_*.scss`) を全収集（`_u-*` ユーティリティ、foundation/ 配下は除外）
2. `docs/patterns/README.md` を Read し、マスターパターンの一覧と各パターンの構造的特徴を把握
3. 収集した各ファイルに **3ゲートフィルタ** を適用:

   **Gate 1 — 移植可能性**: 受講生が全く別の業種のサイトを作るとき、このSCSSの構造は再利用できるか？
   - 特定画像ファイル名（`access_car.png` 等）やハードコード内容（`"2F"` 等）が大半 → 除外
   - ページ固有セクション（特定の施設・サービス紹介等）で構造的な再利用価値がない → 除外

   **Gate 2 — マスターパターン重複**: ファイル名ではなく **コードの構造** でマスターパターンと照合
   - `position: fixed/sticky` + nav list + logo → マスター02 (HEADER_NAV) → 除外
   - hamburger span animation + drawer visibility toggle → マスター03 → 除外
   - `grid-template-columns: repeat(N, 1fr)` + カード構造 → マスター05 → 除外
   - heading のフォント装飾のみ → マスター04 → 除外
   - ただし、マスターパターンの上に **独自技法を大幅に追加** している場合は「マスター補完」として残す

   **Gate 3 — 実質性**: 非自明なCSS技法（アニメーション、疑似要素トリック、状態管理、レイアウトシステム）を含むか？
   - 余白・色・フォントサイズの指定だけ → 除外
   - 実質10行未満の薄いファイル → 除外

4. 3ゲートを通過したファイルを **関連テーマごとにマージ**:
   - 同じUI概念の複数ファイル → 1パターンに統合（例: 複数のhoverバリエーション → HOVER_EFFECTS）
   - タブ系、フォーム系、投稿系など共通テーマをまとめる

5. 各パターンを以下のフォーマットで `docs/patterns-custom/` に保存（**上限15パターン**、超過時は汎用性の高いものを優先）:

   ```markdown
   # パターン: [パターン名]

   ## 用途
   [このパターンが適用される場面を1-2行で]

   ## 受講生のアプローチ
   - [構造的な特徴・技法をリストで]

   ## 再利用シグナル
   [新しいデザインのどんな要素を見たらこのパターンを適用すべきか]

   ## SCSS
   [受講生の記法そのままのコード — 変換しない]
   ```

6. 完了確認: `docs/patterns-custom/` に 1 つ以上のファイルが生成されていること

⚠️ Step 0a が不要 (project-env.md 記入済) でも、Step 0b は独立して実行すること
⚠️ patterns-custom/ が空のまま Step 1 に進むのは、reference-projects/ も空の場合のみ許可
⚠️ ファイル名の接頭辞（`_p-` / `_c-`）でフィルタリングしない — 必ずコード内容で判断する

### Step 1: 共有知識の読み込み (絶対)
1. MCPツール `get_shared_knowledge` を mode="xd" で呼び出し、知識ベースを取得
2. `docs/agent-local.md` が存在すれば読み込む
3. `mcp-log/{page}/page-layout.md` を Read (未生成なら scan に戻る)
4. `docs/project-env.md` を Read (セクション5のCSS記法を把握)
5. `docs/patterns-custom/` にファイルがあれば Read (受講生固有パターン)

### Step 2: blueprint 詳細手順の取得・実行 (絶対)
6. **MCPツール `auto_coding_blueprint` を mode="xd" で必ず呼ぶ** ← 詳細手順は MCP のみ取得可能
7. MCP 応答プロンプトの全指示 (Plan Mode 必須化、座標リスト等) を skip せず実行

### Step 3: 記法変換 (project-env.md が記入済の場合)
8. 計画書 (plan.md) 内の SCSS コードを project-env.md セクション5の記法に合わせる
   - マスターパターンの `rem()` → 受講生の単位変換関数に置換
   - マスターパターンの `@include mq()` → 受講生のメディアクエリ Mixin に置換
   - クラス名の接頭辞を受講生の命名規則に合わせる
9. `docs/patterns-custom/` のパターンがある場合、マスターパターンより優先して適用

### 完了条件 (外形チェック・skip 禁止)
- `mcp-log/{page}/{section}-plan.md` 必須生成
- 計画書に Plan Mode 調査結果 + 主要要素座標リスト記載必須
- 完了報告: 「blueprint 完了 + {section}-plan.md 生成済」を 1 行で

⚠️ Step 1 / Step 2 を skip しての「完了」は禁止
⚠️ plan.md 未生成のままコーディング (build) に進むのは禁止
