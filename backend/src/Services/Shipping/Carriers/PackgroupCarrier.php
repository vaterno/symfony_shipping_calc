<?php

namespace App\Services\Shipping\Carriers;

use App\Services\Parcel\Parcel;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(PackgroupCarrier::SLUG)]
final class PackgroupCarrier implements CarrierInterface
{
    public const string NAME = 'Packgroup';

    public const string SLUG = 'packgroup';
    protected const float PRICE_PER_KG = 1.0;

    public function getSlug(): string
    {
        return self::SLUG;
    }

    public function calculate(Parcel $parcel): Parcel
    {
        // 1 EUR per 1 kg
        $price = $parcel->getWeightKg() * static::PRICE_PER_KG;

        $parcel->setPrice($price);

        return $parcel;
    }
}
