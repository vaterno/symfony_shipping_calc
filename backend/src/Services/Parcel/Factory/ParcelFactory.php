<?php

namespace App\Services\Parcel\Factory;

use App\Services\Currency\CurrencyEnum;
use App\Services\Parcel\Parcel;
use App\Services\Shipping\DTO\ShippingCalcDTO;

class ParcelFactory
{
    public static function createFromShippingCalcDTO(
        ShippingCalcDTO $shippingCalcDTO,
        CurrencyEnum $currency,
    ) {
        /** @var Parcel $parcel */
        $parcel = new Parcel(
            $shippingCalcDTO->weightKg,
            $currency,
            $shippingCalcDTO->carrier
        );

        return $parcel;
    }

}
