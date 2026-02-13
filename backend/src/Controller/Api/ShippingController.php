<?php

namespace App\Controller\Api;

use App\Services\Currency\CurrencyEnum;
use App\Services\Parcel\Factory\ParcelFactory;
use App\Services\Parcel\Parcel;
use App\Services\Shipping\DTO\ShippingCalcDTO;
use App\Services\Shipping\Repository\CarrierRepository;
use App\Services\Shipping\ShippingCalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/shipping', name: 'api_shipping_')]
final class ShippingController extends AbstractController
{
    #[Route('/carriers', name: 'carriers', methods: ['GET'])]
    public function index(
        CarrierRepository $carrierRepository,
    ): JsonResponse {
        $carriers = $carrierRepository->findAll();

        return $this->json([
            'list' => $carriers,
        ]);
    }

    #[Route('/calculate', name: 'calculate', methods: ['POST'])]
    public function calculate(
        #[MapRequestPayload] ShippingCalcDTO $shippingCalcDTO,
        ShippingCalculationService $shippingCalculationService
    ): JsonResponse
    {
        /** @var Parcel $parcel */
        $parcel = ParcelFactory::createFromShippingCalcDTO(
            $shippingCalcDTO,
            CurrencyEnum::EUR
        );
        $shippingCalculationService->calculate($parcel);

        return $this->json($parcel, context: ['groups' => ['parcel:read']]);
    }
}
