<?php

namespace App\Services;

use App\Contracts\MailerInterface;
use App\Models\Price;
use App\Repositories\PriceRepository;

class PriceService
{

    protected PriceRepository $priceRepository;
    protected MailerInterface $mailer;

    public function __construct(PriceRepository $priceRepository, MailerInterface $mailer)
    {
        $this->priceRepository = $priceRepository;
        $this->mailer = $mailer;
    }

    public function addDiscount(int $priceId, int $discount): Price
    {
        $price = $this->priceRepository->updateDiscount($priceId, $discount);

        $this->mailer->raw(
            "You have a new discount of {$discount} SAR on price {$price->price}",
            "test@email.com", 'Price Discount');

        return $price;

    }

}
