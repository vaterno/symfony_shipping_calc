<?php

namespace App\Services\Shipping\Carriers;

use App\Services\Parcel\Parcel;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(TransCompanyCarrier::SLUG)]
final class TransCompanyCarrier implements CarrierInterface
{
    public const string NAME = 'Transcompany';
    public const string SLUG = 'transcompany';
    protected const float THRESHOLD_WEIGHT = 10.0;
    protected const float PRICE_LIGHT = 20.0;
    protected const float PRICE_HEAVY = 100.0;

    public function getSlug(): string
    {
        return self::SLUG;
    }

    public function calculate(Parcel $parcel): Parcel
    {
        $price = ($parcel->getWeightKg() <= static::THRESHOLD_WEIGHT)
            ? static::PRICE_LIGHT
            : static::PRICE_HEAVY;

        $parcel->setPrice($price);

        return $parcel;
    }
}
