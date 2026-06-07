#!/bin/bash
# PreToolUse hook: git commit前にレビュー + pixeldiff 完了を確認
# 以下のいずれかで通過:
#   1. .claude/review-completed マーカーファイルが存在 かつ pixeldiff.md が存在
#   2. コミットメッセージが skip 対象プレフィックス (docs:, chore:, refactor:, test:, style:, ci:, build:, perf:)
#   3. .claude/pipeline-not-required マーカーが存在

INPUT=$(cat)
TOOL_NAME=$(echo "$INPUT" | jq -r '.tool_name')
COMMAND=$(echo "$INPUT" | jq -r '.tool_input.command // empty')

# Bashツール以外は無視
if [ "$TOOL_NAME" != "Bash" ]; then
  exit 0
fi

# git commit コマンドかチェック
if ! echo "$COMMAND" | grep -qE 'git commit'; then
  exit 0
fi

# パイプライン不要マーカーがあれば通過
if [ -f ".claude/pipeline-not-required" ]; then
  exit 0
fi

# Conventional Commits の skip 対象プレフィックス
SKIP_PREFIXES='docs|chore|refactor|test|style|ci|build|perf'

# 1. -m オプションの引数が skip プレフィックスで始まるか
if echo "$COMMAND" | grep -qE "(\-m|\-\-message)[[:space:]]+[\"']?(${SKIP_PREFIXES}):"; then
  exit 0
fi

# 2. HEREDOC 形式の場合、最初の非空白行が skip プレフィックスで始まるか
if echo "$COMMAND" | grep -qE "(EOF|HEREDOC)[[:space:]]*$"; then
  FIRST_MSG_LINE=$(echo "$COMMAND" | sed -n "/<<.*EOF/,/^EOF/{/<<.*EOF/d;/^EOF/d;/^[[:space:]]*$/d;p;}" | head -1)
  if echo "$FIRST_MSG_LINE" | grep -qE "^[[:space:]]*(${SKIP_PREFIXES}):"; then
    exit 0
  fi
fi

# 3. レビュー完了マーカーを確認
if [ ! -f ".claude/review-completed" ]; then
  echo "BLOCK: /review スキルが未実行です。コミット前に必ずセルフレビュー（工程5）を完了してください。" >&2
  echo "" >&2
  echo "手順:" >&2
  echo "  1. /review スキルを実行" >&2
  echo "  2. /pixeldiff スキルを実行" >&2
  echo "  3. 完了後に再度 git commit" >&2
  echo "" >&2
  echo "※ コーディング作業でない場合: touch .claude/pipeline-not-required" >&2
  exit 2
fi

# 4. pixeldiff 成果物を確認
PIXELDIFF_COUNT=$(find mcp-log -name "pixeldiff.md" -type f 2>/dev/null | wc -l | tr -d ' ')
if [ "$PIXELDIFF_COUNT" = "0" ]; then
  echo "BLOCK: /pixeldiff が未実行です。コミット前にピクセル比較（工程6）を完了してください。" >&2
  echo "" >&2
  echo "review は完了していますが、pixeldiff がまだです。" >&2
  echo "  1. /pixeldiff スキルを実行" >&2
  echo "  2. mcp-log/{page}/{section}/pixeldiff.md が生成されたことを確認" >&2
  echo "  3. 完了後に再度 git commit" >&2
  exit 2
fi

exit 0
