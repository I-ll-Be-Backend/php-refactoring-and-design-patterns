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
    public function charge(Ticket $t): float
    {
        if ($t->minutes <= 15) {
            return 0.0;
        }
        return min($t->hours() * 3.0, 20.0);
    }
}
