# KISS: replace a rule engine with plain code, in PHP

> Turn a clever rule engine back into code you read top to bottom.

[Watch the video](https://www.youtube.com/watch?v=Qsoqu3H1U6Q) · [Step through it interactively](https://illbebackend.dev/lessons/kiss-unwind-a-clever-abstraction/php/)

## The problem

Electric cars now park the first two hours free. The ev rule only works if it runs after base and before cap.

## Steps

Each folder holds the complete `ParkingFee.php` after that step, and every one compiles. Diff two neighbouring folders to see a single refactoring.

| Step | What changes | Move |
|---|---|---|
| [01](step-01-a-rule-engine-for-one-fee/) | A rule engine for one fee: charge works out a parking fee by running named closures from an array, in the order a list of strings gives. | Before |
| [02](step-02-the-new-rule-has-to-sit-in-the-right-slo/) | The new rule has to sit in the right slot: Electric cars now park the first two hours free. The ev rule only works if it runs after base and before cap. | Code smell |
| [03](step-03-back-it-out-then-simplify/) | Back it out, then simplify: The ev rule comes out. We simplify the rules array one safe step at a time and add electric cars afterwards. | Plan |
| [04](step-04-there-is-only-one-plan/) | There is only one plan: fee no longer takes a plan. The single list moves inside it, and charge only passes the ticket. | Remove Parameter |
| [05](step-05-three-lines-instead-of-a-loop/) | Three lines instead of a loop: The loop over a fixed list becomes three calls, written in the order the list gave. | Unroll Loop |
| [06](step-06-inline-the-base-rule/) | Inline the base rule: The lookup for base is replaced with the body of its arrow function. Base never read the starting zero, so that line goes too. | Inline Function |
| [07](step-07-inline-the-cap-rule/) | Inline the cap rule: The cap lookup becomes min of the fee and twenty. | Inline Function |
| [08](step-08-inline-grace-delete-the-array/) | Inline grace, delete the array: The last lookup becomes the fifteen minute check. Nothing reads the rules array now, so Remove Dead Code deletes it and its constructor in the same step. | Inline Function |
| [09](step-09-check-the-grace-period-first/) | Check the grace period first: The fifteen minute check slides to the top and returns zero. The rest becomes one return. | Guard Clause |
| [10](step-10-charge-does-the-work-itself/) | charge does the work itself: charge only forwarded to fee, so fee's lines move into charge and fee goes. | Inline Function |
| [11](step-11-name-the-numbers/) | Name the numbers: 3.0, 20.0 and 15 become the class constants HOURLY_RATE, DAILY_CAP and GRACE_MINUTES. | Replace Magic Number |
| [12](step-12-electric-cars-in-reading-order/) | Electric cars, in reading order: Electric cars take two hours off before the rate and the cap apply. The grace check and the other constants didn't change. | Payoff |

## Takeaways

- **Use it when:** An abstraction has one user and one configuration.
- **Skip it when:** The rules truly vary at runtime, like per-garage pricing loaded from config or rules other teams plug in.
- **Spot it by:** String keys looked up in an array, a loop over steps that never change, code you must run in your head.
