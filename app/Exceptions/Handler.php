<?php

namespace App\Exceptions;

//use App\ApiCode;
//use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Route;

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


    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson())
            return ExceptionHandlerHelper::render($request, $exception);
        else {
            if ($exception instanceof TokenMismatchException) {

                if (Route::is('admin.*')) {
                    return route('admin.login');
                } elseif (Route::is('client.*')) {
                    return route('client.login');
                }
                // return redirect('/');
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return abort('404');
            }
            return parent::render($request, $exception);
        }
    }

    private function respondWithValidationError($exception)
    {
        // return ResponseBuilder::asError(ApiCode::VALIDATION_ERROR)
        //     ->withData($exception->errors())
        //     ->withHttpCode(422)
        //     ->build();
        // return ExceptionHandlerHelper::render($request, $e);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = Arr::get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            case 'client':
                $login = 'client.login';
                break;
            default:
                $login = 'admin.login';
                break;
        }

        return redirect()->guest($exception->redirectTo() ?? route($login));
    }
}
