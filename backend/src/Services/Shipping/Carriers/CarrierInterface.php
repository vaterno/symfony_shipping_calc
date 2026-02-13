<?php

namespace App\Services\Shipping\Carriers;

use App\Services\Parcel\Parcel;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface CarrierInterface
{
    public function getSlug(): string;
    public function calculate(Parcel $parcel): Parcel;
}
