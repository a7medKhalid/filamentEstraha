<?php

namespace App\Repositories;

use App\Models\Price;

class PriceRepository
{

    protected Price $price;

    public function __construct(Price $price)
    {
        $this->price = $price;
    }

    public function updateDiscount(int $priceId, int $discount): Price
    {

        $price = $this->price->findOrFail($priceId);
        $price->discount = $discount;
        $price->save();
        return $price;

    }


}
