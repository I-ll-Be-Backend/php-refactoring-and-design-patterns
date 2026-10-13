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
    private const FREE_FROM = 50.0;
    private const MEMBER_FREE_FROM = 25.0;
    public const FEE = 4.99;

    public static function shipsFree(Cart $cart): bool
    {
        return $cart->subtotal >= self::freeFrom($cart);
    }

    public static function amountToFree(Cart $cart): float
    {
        return self::freeFrom($cart) - $cart->subtotal;
    }

    private static function freeFrom(Cart $cart): float
    {
        return $cart->member ? self::MEMBER_FREE_FROM : self::FREE_FROM;
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
            $gap = ShippingPolicy::amountToFree($cart);
            return sprintf('Add $%.2f to ship free', $gap);
        }
        return 'Your order ships free';
    }
}

class OrderEmail
{
    public function shippingLine(Cart $cart): string
    {
        $free = ShippingPolicy::shipsFree($cart);
        return $free ? 'Shipping: free' : 'Shipping: $' . ShippingPolicy::FEE;
    }
}
