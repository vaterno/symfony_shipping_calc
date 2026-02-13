<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistsInDatabase extends Constraint
{
    public string $entityClass;

    public function __construct(
        string $entityClass,
        public string $field = 'id',
        public string $message = 'The value "{{ value }}" does not exist.',
        array $options = []
    ) {
        parent::__construct($options);

        if (!isset($entityClass)) {
            throw new \InvalidArgumentException('The "entityClass" option is required.');
        }

        $this->entityClass = $entityClass;
    }
}
