<?php
final readonly class Booking
{
    public function __construct(
        public DateTimeImmutable $checkIn,
        public float $total,
        public int $nights,
        public string $rate,
        public bool $loyal,
    ) {
    }
}
final class CancellationPolicy
{
    private const FREE_CANCELLATION_DAYS = 14;
    private const LOYALTY_FREE_DAYS = 7;
    private const LAST_MINUTE_DAYS = 2;
    private const NON_REFUNDABLE = 'N';

    public function fee(Booking $b, DateTimeImmutable $today): float
    {
        $daysBeforeCheckIn = (int) $today->diff($b->checkIn)->format('%r%a');
        if ($this->isFreeCancellation($b, $daysBeforeCheckIn)) {
            return 0.0;
        }
        if ($this->paysInFull($b, $daysBeforeCheckIn)) {
            return $b->total;
        }
        $halfTotal = $b->total * 0.5;
        // partner contracts require a one-night minimum
        return max($halfTotal, $this->nightlyPrice($b));
    }

    private function isFreeCancellation(Booking $b, int $days): bool
    {
        if ($b->loyal) {
            return $days >= self::LOYALTY_FREE_DAYS;
        }
        return $days >= self::FREE_CANCELLATION_DAYS;
    }

    private function paysInFull(Booking $b, int $days): bool
    {
        return $b->rate === self::NON_REFUNDABLE
            || $days < self::LAST_MINUTE_DAYS;
    }

    private function nightlyPrice(Booking $b): float
    {
        return $b->total / $b->nights;
    }
}
