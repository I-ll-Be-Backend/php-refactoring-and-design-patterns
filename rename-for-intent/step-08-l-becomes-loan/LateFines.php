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
    public function calc(Loan $loan): float
    {
        $daysLate = $loan->daysOut - 14;
        if ($daysLate <= 0) {
            return 0.0;
        }
        $dailyRate = $loan->student ? 0.10 : 0.25;
        return min($daysLate * $dailyRate, 10.0);
    }
}

final class ReturnDesk
{
    public function __construct(private readonly Fees $fees)
    {
    }

    public function receipt(Loan $loan): string
    {
        return 'Late fine: $' . $this->fees->calc($loan);
    }
}
