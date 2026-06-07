---
name: rca
description: "pixelmatch検証で不合格になった差分画像を分析し、根本原因を特定して修正する。MCPツール auto_coding_rca の呼び出しが必須。"
argument-hint: "[diff画像のパス or セクション名]"
allowed-tools: Read, Edit, Grep, Glob, Bash(node *), Bash(npx gulp build)
---

# 工程: RCA (Root Cause Analysis)

## 🚨 絶対命令 (skip 禁止)

### Step 1: RCA 詳細手順の取得・実行 (絶対)
1. **MCPツール `auto_coding_rca` を mode="xd" で必ず呼ぶ** ← 詳細手順は MCP のみ取得可能
2. MCP 応答プロンプトの指示 (8カテゴリ A-H 分類、「なぜ」3回チェーン、修正提案) を skip せず実行

### 完了条件 (外形チェック・skip 禁止)
- 修正後 mcp-log の pixeldiff.md に RCA ループ履歴を記録
- 完了報告: 「RCA 完了 + 修正適用」を 1 行で

⚠️ MCP 呼び出し skip での「完了」は禁止
