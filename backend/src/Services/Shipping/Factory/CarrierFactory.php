<?php

namespace App\Services\Shipping\Factory;

use Psr\Container\ContainerInterface;
use App\Services\Shipping\Carriers\CarrierInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

class CarrierFactory
{
    public function __construct(
        #[AutowireLocator(CarrierInterface::class)]
        protected ContainerInterface $container,
    ) {
    }

    public function createByAlias(string $alias): CarrierInterface
    {
        if (!$this->container->has($alias)) {
            throw new \InvalidArgumentException(
                sprintf('Carrier with alias "%s" is not supported.', $alias)
            );
        }

        return $this->container->get($alias);
    }
}
