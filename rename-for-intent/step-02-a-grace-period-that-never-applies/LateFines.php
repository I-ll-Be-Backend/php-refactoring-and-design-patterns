<?php

final readonly class Loan
{
    public function __construct(
        public int $d,
        public bool $f,
    ) {
    }
}

final class Fees
{
    public function calc(Loan $l): float
    {
        if ($l->d <= 3) {
            return 0.0;
        }
        $x = $l->d - 14;
        if ($x <= 0) {
            return 0.0;
        }
        $r = $l->f ? 0.10 : 0.25;
        return min($x * $r, 10.0);
    }
}

final class ReturnDesk
{
    public function __construct(private readonly Fees $fees)
    {
    }

    public function receipt(Loan $l): string
    {
        return 'Late fine: $' . $this->fees->calc($l);
    }
}
