<?php

namespace App\Exceptions;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
        // return response()->json(['User have not permission for this page access.']);
        Toastr::warning('Permission not granted. Contact with your administration');
        return redirect(route('dashboard'));
        }
        if ($exception instanceof \Illuminate\Database\QueryException) {
        // return response()->json(['User have not permission for this page access.']);
        //Toastr::warning($exception);
        return response()->json(['error' => $exception]);
        // return redirect()->back()->json(['error'=> $exception]);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            //return redirect(route('dashboard'));
            //Toastr::warning('Something Went Wrong!','Warning');
            abort(404);
            return response()->json(['error' => 'Unauthenticated.'], 401);
            
            //return response()->json(['errors' => $exception]);
        }
        return parent::render($request, $exception);
    }
}
