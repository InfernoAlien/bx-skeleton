#!/bin/bash

ESC_SEQ="\x1b["
COL_RESET=$ESC_SEQ"39;49;00m"
COL_RED=$ESC_SEQ"0;31m"
COL_GREEN=$ESC_SEQ"0;32m"
COL_YELLOW=$ESC_SEQ"0;33m"

changed=$(git diff-index --cached --name-only --diff-filter=ACMR HEAD | grep 'html/public/webpack-assets.json')

echo
printf "$COL_YELLOW%s$COL_RESET\n" "Running pre-commit hook: \"validate-frontend-build\""

if [[ -z "$changed" ]]; then
    echo "Skipped"
    exit 0
fi

grep -q '"mode":"prod"' 'html/public/webpack-assets.json'

# If the grep command has no hits - echo a warning and exit with non-zero status.
if [ $? == 1 ]; then
    printf "$COL_RED%s$COL_RESET\r\n\r\n" "You cannot commit dev frontend build. Please run 'yarn rebuild' or force commit with -n option if you are sure everything is okay"
    exit 1
fi

echo "Okay"
exit 0
