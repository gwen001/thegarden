<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if( $e instanceof ModelNotFoundException ) {
            return response()->json( ['error'=>1,'message'=>'Not found.'], 404 );
        }
        else if( $e instanceof ThrottleRequestsException ) {
            return response()->json( ['error'=>1,'message'=>'Rate limit.'], 429 );
            // return response()->json( ['error'=>1,'message'=>'Not found.'], 404 );
        }
        else if( $e instanceof AuthorizationException ) {
            return response()->json( ['error'=>1,'message'=>'This action is unauthorized.'], 403 );
        }

        return parent::render($request, $e);
    }
}
