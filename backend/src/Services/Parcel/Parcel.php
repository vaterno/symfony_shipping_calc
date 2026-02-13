<?php

namespace App\Services\Parcel;

use App\Services\Currency\CurrencyEnum;
use Symfony\Component\Serializer\Attribute\Groups;

class Parcel
{
    #[Groups(['parcel:read'])]
    protected ?float $weightKg;

    #[Groups(['parcel:read'])]
    protected ?float $price;

    #[Groups(['parcel:read'])]
    protected ?CurrencyEnum $currency;

    #[Groups(['parcel:read'])]
    protected ?string $carrier;

    public function __construct(
        float $weightKg,
        ?CurrencyEnum $currency,
        ?string $carrier,
    ) {
        if ($weightKg <= 0) {
            throw new \InvalidArgumentException('Weight must be positive');
        }

        $this->weightKg = $weightKg;
        $this->currency = $currency;
        $this->carrier = $carrier;
    }

    public function getWeightKg(): float
    {
        return $this->weightKg;
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getCurrency(): ?CurrencyEnum
    {
        return $this->currency;
    }

    public function setCarrier(string $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function setPrice(float $shippingCost): static
    {
        $this->price = $shippingCost;

        return $this;
    }
}
