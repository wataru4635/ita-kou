---
name: scan
description: "工程2のXDレイヤー分析を実行する。デザインコンテキスト取得後に自動発動する。MCPツール auto_coding_scan の呼び出しが必須。"
user-invocable: false
allowed-tools: Read, Glob, Grep, Write, Edit, Bash, Agent
---

# 工程2: XDレイヤー分析

## 🚨 絶対命令 (skip 禁止)

この skill が呼ばれたら以下を必ず順に実行:

### Step 1: 共有知識の読み込み (絶対)
1. MCPツール `get_shared_knowledge` を mode="xd" で呼び出し、知識ベースを取得
2. `docs/agent-local.md` が存在すれば読み込む

### Step 2: scan 詳細手順の取得・実行 (絶対)
3. **MCPツール `auto_coding_scan` を mode="xd" で必ず呼ぶ** ← 詳細手順は MCP のみ取得可能
4. MCP 応答プロンプトの指示を skip せず実行

### 完了条件 (外形チェック・skip 禁止)
- `mcp-log/{page}/page-layout.md` 必須生成 (ページ初回のみ)
- `mcp-log/{page}/{section}-layer-analysis.md` 必須生成
- 完了報告: 「scan 完了 + page-layout.md 生成済」を 1 行で

⚠️ Step 1 / Step 2 を skip して「完了」報告は禁止
⚠️ MCP 応答プロンプトを読まずに作業も禁止
⚠️ page-layout.md 未生成のまま blueprint に進むのは禁止
