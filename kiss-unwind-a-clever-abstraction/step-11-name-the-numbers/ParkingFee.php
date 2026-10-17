<?php
final readonly class Ticket
{
    public function __construct(
        public int $minutes,
        public bool $electric,
    ) {
    }

    public function hours(): int
    {
        return intdiv($this->minutes + 59, 60);
    }
}
final class ParkingFee
{
    private const HOURLY_RATE = 3.0;
    private const DAILY_CAP = 20.0;
    private const GRACE_MINUTES = 15;

    public function charge(Ticket $t): float
    {
        if ($t->minutes <= self::GRACE_MINUTES) {
            return 0.0;
        }
        return min($t->hours() * self::HOURLY_RATE, self::DAILY_CAP);
    }
}
