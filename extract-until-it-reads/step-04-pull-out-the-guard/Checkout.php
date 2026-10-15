<?php
final readonly class Item
{
    public function __construct(
        public string $name,
        public float $price,
        public int $qty,
    ) {
    }
}

final readonly class Order
{
    /** @param list<Item> $items */
    public function __construct(
        public array $items,
        public bool $express,
        public bool $member,
    ) {
    }
}

final class Checkout
{
    public function confirm(Order $order): string
    {
        $this->requireItems($order);
        $total = 0.0;
        foreach ($order->items as $item) {
            $total += $item->price * $item->qty;
        }
        $total += $total < 50.0 ? 4.99 : 0.0;
        $total += $order->express ? 7.50 : 0.0;
        return sprintf('%d items, $%.2f',
            count($order->items), $total);
    }

    private function requireItems(Order $order): void
    {
        if ($order->items === []) {
            throw new InvalidArgumentException('No items');
        }
    }
}
