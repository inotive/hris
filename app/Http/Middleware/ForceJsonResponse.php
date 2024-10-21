<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Check if the request is for the API (typically by checking the URL)
        if ($request->is('api/*')) {
            // Force the Accept header to application/json
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Content-Type', 'application/json');
        }

        $originalData = $request->all();
        $snakeCaseData = $this->snakeCaseArrayKeys($originalData);
        $request->replace($snakeCaseData);

        $response = $next($request);

        $data = $response->getData(true);
        $camelCasedData = $this->camelCaseArrayKeys($data);
        $response->setData($camelCasedData);



        return $response;
    }


    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                    'errors' => $exception->errors(),
                ], 400);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'exception' => $exception->getMessage(), // Optional: hide in production
            ], 500);
        }

        // return $this->render($request, $exception);
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong',
            'exception' => $exception->getMessage(), // Optional: hide in production
        ], 500);
    }

    private function camelCaseArrayKeys(array $array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $camelKey = \Str::camel($key);
            $result[$camelKey] = is_array($value) ? $this->camelCaseArrayKeys($value) : $value;
        }
        return $result;
    }

    private function snakeCaseArrayKeys(array $array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $snakeKey = \Str::snake($key);
            $result[$snakeKey] = is_array($value) ? $this->snakeCaseArrayKeys($value) : $value;
        }
        return $result;
    }

}
