<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ValidationExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ValidationFailedException) {
            if ($exception->getPrevious() instanceof ValidationFailedException) {
                $exception = $exception->getPrevious();
            } else {
                return;
            }
        }

        $errors = [];

        foreach ($exception->getViolations() as $violation) {
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        $event->setResponse(new JsonResponse([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors'  => $errors,
        ], 422));
    }
}
