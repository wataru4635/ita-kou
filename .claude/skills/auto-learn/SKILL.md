---
name: auto-learn
description: "作業中に知見を検出したら自動的に docs/agent-local.md に知識を記録する。コーディング作業中に常にバックグラウンドで監視する。"
user-invocable: false
allowed-tools: Read, Edit, Grep
---

MCPツール `auto_coding_auto_learn` を mode="xd" で呼び出し、返却されたプロンプトの指示に従って実行せよ。
ただし書き込み先は docs/agent-local.md とする（docs/agent.md ではない）。
