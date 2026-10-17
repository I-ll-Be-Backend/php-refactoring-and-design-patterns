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
    /** @var array<string, Closure(Ticket, float): float> */
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            'base' => fn($t, $f) => $t->hours() * 3.0,
            'cap' => fn($t, $f) => min($f, 20.0),
            'grace' => fn($t, $f) => $t->minutes <= 15 ? 0.0 : $f,
        ];
    }

    /** @param list<string> $plan */
    public function fee(Ticket $t, array $plan): float
    {
        $f = 0.0;
        foreach ($plan as $name) {
            $f = ($this->rules[$name])($t, $f);
        }
        return $f;
    }

    public function charge(Ticket $t): float
    {
        return $this->fee($t, ['base', 'cap', 'grace']);
    }
}
