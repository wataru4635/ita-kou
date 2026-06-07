---
name: learn
description: "docs/agent-local.mdに知識（落とし穴・パターン・改善事項）を記録する。"
user-invocable: true
argument-hint: "[記録したい知識の概要]"
allowed-tools: Read, Edit, Grep
---

MCPツール `auto_coding_learn` を mode="xd" で呼び出し、返却されたプロンプトの指示に従って実行せよ。
ただし書き込み先は docs/agent-local.md とする（docs/agent.md ではない）。
