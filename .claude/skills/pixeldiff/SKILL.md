---
name: pixeldiff
description: "工程6のピクセルパーフェクト検証をオンデマンドで実行する。MCPツール auto_coding_pixeldiff の呼び出しが必須。"
user-invocable: true
argument-hint: "[XD section name(s)]"
allowed-tools: Read, Edit, Grep, Glob, Bash(node *), Bash(npx gulp build), Bash(curl *), Bash(export *)
---

# 工程6: pixeldiff

## 🚨 絶対命令 (skip 禁止)

### Step 1: pixeldiff 詳細手順の取得・実行 (絶対)
1. **MCPツール `auto_coding_pixeldiff` を mode="xd" で必ず呼ぶ** ← 詳細手順は MCP のみ取得可能
2. MCP 応答プロンプトの全手順を実行 (実装スクショ撮影、XD 画像 DL、比較、RCA 自動 3 ループ)

### 完了条件 (外形チェック・skip 禁止)
- `mcp-log/{page}/{section}/pixeldiff.md` 必須生成 (初回 + 最終スコア両方記録)
- `mcp-log/{page}/pixeldiff-all.md` 集計表更新
- マッチ率 90% 未満 → /rca skill を発動
- 完了報告: 「pixeldiff 完了 + 最終マッチ率 X%」を 1 行で

⚠️ MCP 呼び出し skip での「完了」は禁止
⚠️ pixeldiff.md 未生成での「完了」は禁止
