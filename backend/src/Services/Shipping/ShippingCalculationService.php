<?php

namespace App\Services\Shipping;

use App\Services\Parcel\Parcel;
use App\Services\Shipping\Factory\CarrierFactory;
use App\Services\Shipping\Carriers\CarrierInterface;

class ShippingCalculationService
{
    public function __construct(
        protected CarrierFactory $carrierFactory
    ) {
    }

    public function calculate(Parcel $parcel): Parcel
    {
        /** @var CarrierInterface $carrier */
        $carrier = $this->carrierFactory->createByAlias($parcel->getCarrier());
        $carrier->calculate($parcel);

        return $parcel;
    }
}
