# Clean code: extract until it reads, in PHP

> Turn a long method into named steps you can read from top to bottom.

[Watch the video](https://www.youtube.com/watch?v=KfRNymoxNhA) · [Step through it interactively](https://illbebackend.dev/lessons/extract-until-it-reads/php/)

## The problem

The member discount multiplies $total after delivery was added, so it takes ten percent off the fees too.

## Steps

Each folder holds the complete `Checkout.php` after that step, and every one compiles. Diff two neighbouring folders to see a single refactoring.

| Step | What changes | Move |
|---|---|---|
| [01](step-01-a-checkout-that-works/) | A checkout that works: confirm checks the order, adds up the items, adds delivery and returns the message, all in one method. | Before |
| [02](step-02-a-discount-in-the-wrong-place/) | A discount in the wrong place: The member discount multiplies $total after delivery was added, so it takes ten percent off the fees too. | Code smell |
| [03](step-03-undo-then-extract/) | Undo, then extract: Back the discount out. Extract one job at a time until confirm reads as a list of steps. | Plan |
| [04](step-04-pull-out-the-guard/) | Pull out the guard: The empty-order check moves into requireItems. | Extract Method |
| [05](step-05-pull-out-the-subtotal/) | Pull out the subtotal: The loop moves into subtotal, with its own running $sum. | Extract Method |
| [06](step-06-one-name-per-meaning/) | One name per meaning: $goods holds the subtotal. $total starts from it, and the free delivery check reads $goods. | Split Variable |
| [07](step-07-pull-out-delivery/) | Pull out delivery: Both delivery rules move into deliveryFee. The message line stays, because it already says what it does. | Extract Method |
| [08](step-08-the-discount-in-the-right-place/) | The discount, in the right place: memberDiscount is new, and confirm takes it off the goods before adding the delivery fee. requireItems, subtotal and deliveryFee didn't change. | Payoff |

## Takeaways

- **Use it when:** You have to read a whole method to find the part you need to change.
- **Skip it when:** The lines already say what they do, and a method named after them would only repeat them.
- **Spot it by:** Long methods, comments that label each section, and one variable that means different things as it goes.
