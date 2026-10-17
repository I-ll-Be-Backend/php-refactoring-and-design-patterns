# PHP Refactoring and Design Patterns

Code from the [I'll Be Backend](https://www.youtube.com/@illbebackend) videos: messy PHP code gets better, one small, safe refactoring at a time. Every lesson has a video, an [interactive version](https://illbebackend.dev) you can step through, and a folder here with the code after every step.

## Code smells

| Lesson | Steps | Video | Interactive |
|---|---|---|---|
| [Clean code: replace comments with code](replace-comments-with-code/) | 14 | [Watch](https://www.youtube.com/watch?v=BwQcmyELNAY) | [Open](https://illbebackend.dev/lessons/replace-comments-with-code/php/) |

## Principles

| Lesson | Steps | Video | Interactive |
|---|---|---|---|
| [DRY: one rule, one place](dry/) | 11 | [Watch](https://www.youtube.com/watch?v=aPzehq2Hnik) | [Open](https://illbebackend.dev/lessons/dry/php/) |
| [Clean code: extract until it reads](extract-until-it-reads/) | 8 | [Watch](https://www.youtube.com/watch?v=KfRNymoxNhA) | [Open](https://illbebackend.dev/lessons/extract-until-it-reads/php/) |
| [KISS: replace a rule engine with plain code](kiss-unwind-a-clever-abstraction/) | 12 | [Watch](https://www.youtube.com/watch?v=Qsoqu3H1U6Q) | [Open](https://illbebackend.dev/lessons/kiss-unwind-a-clever-abstraction/php/) |
| [Clean code: rename for intent](rename-for-intent/) | 13 | [Watch](https://www.youtube.com/watch?v=s6HNKKbXnGE) | [Open](https://illbebackend.dev/lessons/rename-for-intent/php/) |

## How to use it

- Open a lesson folder and read its README, then the step folders in order.
- `sh check.sh` compiles every step in Docker with `ghcr.io/phpstan/phpstan:2-php8.3`, the same check every lesson passed before its video went out.
- Found a bug in a lesson? Open an issue.

## License

The code is [MIT No Attribution](LICENSE): use it however you like. The videos, the name and the logo are covered by the [terms](https://illbebackend.dev/terms/).
