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
    private const LAST_MINUTE_DAYS = 2;
    private const NON_REFUNDABLE = 'N';

    public function fee(Booking $b, DateTimeImmutable $today): float
    {
        $daysBeforeCheckIn = (int) $today->diff($b->checkIn)->format('%r%a');
        if ($this->isFreeCancellation($daysBeforeCheckIn)) {
            return 0.0;
        }
        // non-refundable or under 2 days out: pay in full
        if (
            $b->rate === self::NON_REFUNDABLE
            || $daysBeforeCheckIn < self::LAST_MINUTE_DAYS
        ) {
            return $b->total;
        }
        // otherwise half the total
        $f = $b->total * 0.5;
        // partner contracts require a one-night minimum
        return max($f, $b->total / $b->nights);
    }

    private function isFreeCancellation(int $days): bool
    {
        return $days >= self::FREE_CANCELLATION_DAYS;
    }
}
