<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractBaseRequest
{
    public function __construct(
        private readonly ValidatorInterface $validator,
    )
    {
        $this->boot();
    }

    final public function validate(): void
    {
        $errors = $this->validator->validate($this);

        $messages = ['message' => $this->getMessage(), 'errors' => []];

        /** @var ConstraintViolation $message */
        foreach ($errors as $message) {
            $messages['errors'][] = $this->errorMessageStructure($message);
        }

        if (count($messages['errors']) > 0) {
            $response = new JsonResponse($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
            $response->send();

            exit;
        }
    }

    protected function getMessage(): string
    {
        return 'validation_failed';
    }

    protected function errorMessageStructure(ConstraintViolation $message): array
    {
        return [
            'property' => $message->getPropertyPath(),
            'value' => $message->getInvalidValue(),
            'message' => $message->getMessage(),
        ];
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }

    protected function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    protected function populate(): void
    {
        foreach ($this->getRequest()->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    protected function boot(): void
    {
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }
    }
}