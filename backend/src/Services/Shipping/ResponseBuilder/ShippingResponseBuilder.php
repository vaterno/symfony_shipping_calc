<?php

namespace App\Services\Shipping\ResponseBuilder;

use App\Entity\Carrier;
use App\Services\Parcel\Parcel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class ShippingResponseBuilder
{
    public function __construct(
        protected SerializerInterface $serializer,
    ) {}

    /**
     * @param Carrier[] $carriers
     */
    public function buildCarriersResponse(array $carriers, int $status = 200, array $headers = [], bool $isJson = true): JsonResponse
    {
        $result = $this->serializer->serialize($carriers, 'json', ['groups' => ['carrier:list']]);

        return new JsonResponse($result, $status, $headers, $isJson);
    }

    /**
     * @param Parcel $parcel
     */
    public function buildCalculateResponse(Parcel $parcel, int $status = 200, array $headers = [], bool $isJson = true): JsonResponse
    {
        $result = $this->serializer->serialize($parcel, 'json', ['groups' => ['parcel:read']]);

        return new JsonResponse($result, $status, $headers, $isJson);
    }
}
