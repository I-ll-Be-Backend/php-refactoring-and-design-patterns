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
    public function fee(Booking $b, DateTimeImmutable $today): float
    {
        // days left before check-in
        $d = (int) $today->diff($b->checkIn)->format('%r%a');
        // free cancellation 14 days or more before check-in
        if ($d >= 14) {
            return 0.0;
        }
        // non-refundable or under 2 days out: pay in full
        if ($b->rate === 'N' || $d < 2) {
            return $b->total;
        }
        // otherwise half the total
        $f = $b->total * 0.5;
        // partner contracts require a one-night minimum
        return max($f, $b->total / $b->nights);
    }
}
