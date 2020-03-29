<?php

namespace Presentation\Exceptions;

use Application\Exceptions\EntityNotFoundException;
use Application\Exceptions\ExistingEntityException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected array $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected array $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof BasePresentationException) {
            return response()->json([ 'error' => $exception->getResponseMessage() ],$exception->getStatusCode());
        }

        if ($exception instanceof ExistingEntityException) {
            return response()->json([ 'error' => $exception->getMessage() ], 422);
        }

        if ($exception instanceof EntityNotFoundException) {
            return response()->json([ 'error' => $exception->getMessage() ], 404);
        }

        return parent::render($request, $exception);
    }
}
