<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $statusCode = $exception->getCode() ?: Response::HTTP_BAD_REQUEST;

        $response = new JsonResponse(
            data: [
                'message' => $exception->getMessage(),
                'errorCode' => $statusCode,
            ],
            status: $statusCode,
        );

        $event->setResponse($response);
    }
}