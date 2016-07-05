<?php

namespace Restful\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    public function report(Exception $e)
    {
        return parent::report($e);
    }
    
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
            return \Response::json(['error' => 'Model not found'], 404);
            
        }

        if ($e instanceof NotFoundHttpException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
            return \Response::json(['error' => 'Sorry, we can\'t find that.'], 404);
        }

        return parent::render($request, $e);
    }
}
