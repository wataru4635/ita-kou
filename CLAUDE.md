# プロジェクトルール

## モード

このプロジェクトは **xd** モードで動作する。
MCPツール呼び出し時は常に mode="xd" を指定すること。

## ゲート（違反時は即中断）

1. コーディング完了報告の前に、必ず /review スキルを実行すること。未実行の完了報告は禁止。
2. 各セクション完了ごとに /pixeldiff でマッチ率を出して mcp-log/{page}/pixeldiff.md に保存すること。全セクション完了後に総合のマッチ率一覧を pixeldiff-all.md にまとめること。nccの数値もまとめること。
3. コーディング着手前に MCPツール `get_pipeline` でパイプライン工程順序を確認すること。工程のスキップは禁止。
4. 判断に迷ったら MCPツールで該当ドキュメントを再取得すること。
5. **scan/blueprint/build実行前に、必ず `get_shared_knowledge` で共有知識ベースを読み込むこと。** コンテキスト圧縮が発生した場合も、各工程の開始時に再取得すること。共有知識なしでの工程実行は禁止。

   **また、blueprint/build 工程に進む前に必ず scan 工程を実行し、`mcp-log/{page}/page-layout.md` を生成すること。** skill engine がない MCP 環境では scan は自動発動しないため、メインエージェントから明示的に Agent ツール (Task) 経由でサブエージェントに scan SKILL を実行させるか、または `get_scan_guide` で取得した手順 (xd-file/ JSON の bounds 解析 → グループ間 y 間隔抽出 → page-layout.md 出力) を実行すること。**page-layout.md なしでの blueprint 進行は禁止**。
6. **build（コーディング）着手前に、必ず `docs/CODING_RULES.md` を読み込むこと。** 特にSCSS入れ子禁止・rem()必須を確認すること。CODING_RULES未読でのコーディングは禁止。
7. **コンテキスト圧縮（compacting）が発生した場合、直後に必ず `get_compact_rules` を呼び出すこと。** 圧縮により工程手順・ルールが失われている可能性があるため、compact_rulesで必須ルールを再確認する。未実行での作業続行は禁止。

## デザインカンプ取得

XDなど非Figmaのデザインカンプを使用する場合は、MCPツール `get_xd_prompt` で手順を取得すること。

## ドキュメント体系

- パイプライン手順: MCPツール `get_pipeline` で取得
- コーディング規約: docs/CODING_RULES.md（ローカル・カスタマイズ可）
- セルフレビュー項目: MCPツール `get_review_checklist` で取得
- 共有知識ベース: MCPツール `get_shared_knowledge` で取得
- 個人知識: docs/agent-local.md（ローカル・自動蓄積）
