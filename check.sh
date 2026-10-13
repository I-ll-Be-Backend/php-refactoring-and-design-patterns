#!/bin/sh
# Compiles every step of every lesson in ghcr.io/phpstan/phpstan:2-php8.3: the check each lesson passed before its video went out.
# Needs Docker. A step folder holding .nocheck does not compile on purpose and is skipped.
docker run --rm --entrypoint /bin/sh -v "$PWD:/w" ghcr.io/phpstan/phpstan:2-php8.3 -c '
true
cd /w; fail=0
for f in */step-*/*.php; do
  [ -e "$f" ] || continue
  [ -e "$(dirname "$f")/.nocheck" ] && continue
  d=$(mktemp -d)
  if ( phpstan analyse --no-progress --error-format=raw --level=6 $f ) >/tmp/log 2>&1; then echo "ok    $f"; else echo "FAIL  $f"; cat /tmp/log; fail=1; fi
done
exit $fail'
