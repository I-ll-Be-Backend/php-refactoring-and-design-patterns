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
        $goods = $this->subtotal($order);
        $discount = $this->memberDiscount($order, $goods);
        $total = $goods - $discount + $this->deliveryFee($order, $goods);
        return sprintf('%d items, $%.2f',
            count($order->items), $total);
    }

    private function requireItems(Order $order): void
    {
        if ($order->items === []) {
            throw new InvalidArgumentException('No items');
        }
    }

    private function subtotal(Order $order): float
    {
        $sum = 0.0;
        foreach ($order->items as $item) {
            $sum += $item->price * $item->qty;
        }
        return $sum;
    }

    private function memberDiscount(Order $order, float $goods): float
    {
        return $order->member ? $goods * 0.10 : 0.0;
    }

    private function deliveryFee(Order $order, float $goods): float
    {
        $fee = 0.0;
        $fee += $goods < 50.0 ? 4.99 : 0.0;
        $fee += $order->express ? 7.50 : 0.0;
        return $fee;
    }
}
