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
    private const LOAN_DAYS = 14;
    private const STUDENT_RATE = 0.10;
    private const STANDARD_RATE = 0.25;
    private const MAX_FINE = 10.0;

    public function overdueFine(Loan $loan): float
    {
        $daysLate = $loan->daysOut - self::LOAN_DAYS;
        if ($daysLate <= 0) {
            return 0.0;
        }
        $dailyRate = $loan->student
            ? self::STUDENT_RATE
            : self::STANDARD_RATE;
        return min($daysLate * $dailyRate, self::MAX_FINE);
    }
}

final class ReturnDesk
{
    public function __construct(private readonly Fees $fees)
    {
    }

    public function receipt(Loan $loan): string
    {
        return 'Late fine: $' . $this->fees->overdueFine($loan);
    }
}
