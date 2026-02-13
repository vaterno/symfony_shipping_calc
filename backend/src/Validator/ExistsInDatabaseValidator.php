<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;

class ExistsInDatabaseValidator extends ConstraintValidator
{
    public function __construct(private EntityManagerInterface $em) {}

    public function validate($value, Constraint $constraint)
    {
        if (!$value) {
            return;
        }

        $repo = $this->em->getRepository($constraint->entityClass);

        $exists = $repo->findOneBy([$constraint->field => $value]);

        if (!$exists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', (string) $value)
                ->addViolation();
        }
    }
}
