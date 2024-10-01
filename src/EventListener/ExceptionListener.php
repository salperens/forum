<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;

final class ExceptionListener
{
    public function __construct(protected readonly KernelInterface $kernel)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $event->setResponse(
            $this->makeResponse($event->getThrowable())
        );
    }

    protected function makeResponse(\Throwable $exception): JsonResponse
    {
        $statusCode = $exception->getCode() ?: Response::HTTP_BAD_REQUEST;

        $data = [
            'message' => $exception->getMessage(),
            'errorCode' => $statusCode,
        ];

        if ($this->kernel->getEnvironment() === 'dev') {
            $data['trace'] = $exception->getTrace();
        }

        return new JsonResponse(
            data: $data,
            status: Response::HTTP_BAD_REQUEST,
        );
    }
}