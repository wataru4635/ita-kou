#!/bin/bash
# Stop hook: セッション終了前にパイプライン完了を確認
#
# mcp-log 内に pixeldiff 結果が存在しない場合、セッション終了をブロック。
# 「完了しました」と口頭報告しても、実際の成果物がなければ終了できない。
#
# バイパス条件:
#   - .claude/pipeline-not-required マーカーが存在（修正指示対応など、パイプライン不要な作業）
#   - mcp-log ディレクトリが存在しない（パイプライン作業が未開始 = コーディング作業ではない）

# パイプライン不要マーカーがあれば通過
if [ -f ".claude/pipeline-not-required" ]; then
  exit 0
fi

# mcp-log が存在しない = コーディング作業ではない（docs編集等）
if [ ! -d "mcp-log" ]; then
  exit 0
fi

# mcp-log 内に pixeldiff.md が1つも存在しないかチェック
PIXELDIFF_COUNT=$(find mcp-log -name "pixeldiff.md" -type f 2>/dev/null | wc -l | tr -d ' ')

if [ "$PIXELDIFF_COUNT" = "0" ]; then
  echo "BLOCK: pixeldiff が未実行です。セッションを終了できません。" >&2
  echo "" >&2
  echo "パイプラインの工程5（review）→ 工程6（pixeldiff）を完了してから、" >&2
  echo "改めて完了報告をしてください。" >&2
  echo "" >&2
  echo "工程:" >&2
  echo "  1. /review でセルフレビューを実行" >&2
  echo "  2. /pixeldiff でピクセル比較を実行" >&2
  echo "  3. mcp-log/{page}/{section}/pixeldiff.md が生成されたことを確認" >&2
  echo "" >&2
  echo "※ コーディング作業でない場合: touch .claude/pipeline-not-required" >&2
  exit 2
fi

# review完了マーカーも確認
if [ ! -f ".claude/review-completed" ]; then
  echo "BLOCK: /review が未完了です。セッションを終了できません。" >&2
  echo "" >&2
  echo "pixeldiff は検出されましたが、review 完了マーカーがありません。" >&2
  echo "/review スキルを実行してからセッションを完了してください。" >&2
  exit 2
fi

exit 0
