<?php

namespace App\Services\Shipping\DTO;

use App\Entity\Carrier;
use App\Validator\ExistsInDatabase;
use Symfony\Component\Validator\Constraints as Assert;

class ShippingCalcDTO
{
    #[Assert\NotBlank]
    #[ExistsInDatabase(entityClass: Carrier::class, field: 'slug', message: 'Unsupported carrier')]
    public string $carrier;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public float $weightKg;
}
