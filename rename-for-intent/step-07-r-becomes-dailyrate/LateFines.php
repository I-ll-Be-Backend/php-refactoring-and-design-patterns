<?php

final readonly class Loan
{
    public function __construct(
        public int $daysOut,
        public bool $student,
    ) {
    }
}

final class Fees
{
    public function calc(Loan $l): float
    {
        $daysLate = $l->daysOut - 14;
        if ($daysLate <= 0) {
            return 0.0;
        }
        $dailyRate = $l->student ? 0.10 : 0.25;
        return min($daysLate * $dailyRate, 10.0);
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
