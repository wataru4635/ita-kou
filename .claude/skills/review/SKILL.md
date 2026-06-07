---
name: review
description: "工程5セルフレビュー。コーディング完了後に自動発動する。1セクションのコーディングが完了するたびに呼び出すこと。MCPツール auto_coding_review の呼び出しが必須。"
user-invocable: false
allowed-tools: Read, Grep, Glob, Edit, Bash(npx gulp build), Bash(touch *), Bash(rm *), Bash(node *)
---

# 工程5: セルフレビュー

## 🚨 絶対命令 (skip 禁止)

### Step 1: 共有知識の読み込み (絶対)
1. MCPツール `get_shared_knowledge` を mode="xd" で呼び出し、知識ベースを取得

### Step 2: review 詳細手順の取得・実行 (絶対)
2. **MCPツール `auto_coding_review` を mode="xd" で必ず呼ぶ** ← 詳細手順は MCP のみ取得可能
3. MCP 応答プロンプトの A〜F 全項目を skip せず実行 (D-2 高さ検証ゲート、F. レスポンシブ実装検証含む)

### 完了条件 (外形チェック・skip 禁止)
- 各 `.p-section` クラス内に `@include mq("md")` (or 同等のメディアクエリ) があること (F. レスポンシブ)
- 実装高さと XD frame.height の差が ±5% 以内 (D-2)
- レビュー全 OK → 自動的に /pixeldiff を発動
- 完了報告: 「review 完了 + 全項目 OK」を 1 行で

⚠️ MCP 呼び出し skip での「完了」は禁止
⚠️ F. レスポンシブが 0 件のまま completed は禁止
⚠️ D-2 高さズレ ±5% 超のまま pixeldiff 進行は禁止
