<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
     * @param Throwable $exception
     * @throws Exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @throws Throwable
     * @return Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof UnauthorizedException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => (string) $exception->getMessage(),
                ], (int) $exception->getCode());
            }
            return redirect()->route('login');
        }

        if ($exception instanceof SmarecoSpecificationExceptionInterface) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => (string) $exception->getMessage(),
                ], (int) $exception->getCode());
            }
            abort(500, $exception->getMessage());
        }

        if ($exception instanceof Throwable) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => (string) $exception->getMessage(),
                ], (int) $exception->getCode());
            }
        }

        return parent::render($request, $exception);
    }
}
