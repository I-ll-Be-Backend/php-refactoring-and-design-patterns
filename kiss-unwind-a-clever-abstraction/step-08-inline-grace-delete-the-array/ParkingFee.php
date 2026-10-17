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
    public function fee(Ticket $t): float
    {
        $f = $t->hours() * 3.0;
        $f = min($f, 20.0);
        $f = $t->minutes <= 15 ? 0.0 : $f;
        return $f;
    }

    public function charge(Ticket $t): float
    {
        return $this->fee($t);
    }
}
