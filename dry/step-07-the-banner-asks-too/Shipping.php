<?php
final class Cart
{
    public function __construct(
        public readonly float $subtotal,
        public readonly bool $member,
    ) {
    }
}

final class ShippingPolicy
{
    public const FREE_FROM = 50.0;
    public const FEE = 4.99;

    public static function shipsFree(Cart $cart): bool
    {
        return $cart->subtotal >= self::FREE_FROM;
    }
}

class Checkout
{
    public function shippingFee(Cart $cart): float
    {
        if (ShippingPolicy::shipsFree($cart)) {
            return 0.0;
        }
        return ShippingPolicy::FEE;
    }
}

class CartBanner
{
    public function message(Cart $cart): string
    {
        if (!ShippingPolicy::shipsFree($cart)) {
            $gap = ShippingPolicy::FREE_FROM - $cart->subtotal;
            return sprintf('Add $%.2f to ship free', $gap);
        }
        return 'Your order ships free';
    }
}

class OrderEmail
{
    public function shippingLine(Cart $cart): string
    {
        $free = $cart->subtotal >= ShippingPolicy::FREE_FROM;
        return $free ? 'Shipping: free' : 'Shipping: $' . ShippingPolicy::FEE;
    }
}
