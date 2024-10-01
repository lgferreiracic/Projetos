<?php

namespace App\Exceptions;

use Throwable;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // return $this->handleException($request, $exception);

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'Entry for ' . str_replace('App\\', '', $exception->getModel()) . ' not found'
            ], 404);
        }

        return parent::render($request, $exception);
    }

    // public function handleException($request, Throwable $exception)
    // {

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse('The specified method for the request is invalid', 405);
    //     }

    //     if ($exception instanceof NotFoundHttpException) {
    //         return $this->errorResponse('The specified URL cannot be found', 404);
    //     }

    //     if ($exception instanceof HttpException) {
    //         return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
    //     }

    //     if ($exception instanceof HttpResponseException) {
    //         return $this->errorResponse($exception->getResponse());
    //     }

    //     if ($exception instanceof AuthenticationException) {
    //         return $this->errorResponse($this->unauthenticated($request, $exception));
    //     }

    //     if ($exception instanceof ValidationException) {
    //         return $this->errorResponse('$this->convertValidationExceptionToResponse($exception, $request)');
    //     }

    //     if (config('app.debug')) {
    //         return parent::render($request, $exception);
    //     }

    //     return $this->errorResponse('Unexpected Exception. Try later', 500);
    // }
}
