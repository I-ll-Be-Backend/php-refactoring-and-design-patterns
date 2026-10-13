<?php
final class Cart
{
    public function __construct(
        public readonly float $subtotal,
        public readonly bool $member,
    ) {
    }
}

class Checkout
{
    public function shippingFee(Cart $cart): float
    {
        if ($cart->subtotal >= 50.0) {
            return 0.0;
        }
        return 4.99;
    }
}

class CartBanner
{
    public function message(Cart $cart): string
    {
        if ($cart->subtotal < 50.0) {
            $gap = 50.0 - $cart->subtotal;
            return sprintf('Add $%.2f to ship free', $gap);
        }
        return 'Your order ships free';
    }
}

class OrderEmail
{
    public function shippingLine(Cart $cart): string
    {
        $free = $cart->subtotal >= 50.0;
        return $free ? 'Shipping: free' : 'Shipping: $4.99';
    }
}
