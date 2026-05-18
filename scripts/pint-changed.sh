#!/usr/bin/env bash

set -euo pipefail

mapfile -t files < <(
    {
        git diff --name-only --diff-filter=ACMR HEAD -- '*.php'
        git ls-files --others --exclude-standard -- '*.php'
    } | sort -u
)

if [ "${#files[@]}" -eq 0 ]; then
    echo "No modified PHP files to format."
    exit 0
fi

./vendor/bin/pint "${files[@]}"
