<?php

namespace App\Exceptions;

use App\Exceptions\HttpExceptionHandlers\{
    DomainExceptionHandler,
    EntityNotFoundHandler,
    HttpHandler,
    InvalidArgumentExceptionHandler,
    InvalidOrExpiredBearerTokenHandler,
    MissingBearerTokenHandler,
    QueryExceptionHandler,
    ValidationExceptionHandler,
};
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    private HttpHandler $collectionHandler;

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->collectionHandler = new DomainExceptionHandler();
        $this->collectionHandler
            ->next(new EntityNotFoundHandler())
            ->next(new InvalidArgumentExceptionHandler())
            ->next(new InvalidOrExpiredBearerTokenHandler())
            ->next(new MissingBearerTokenHandler())
            ->next(new QueryExceptionHandler())
            ->next(new ValidationExceptionHandler());

        $this->reportable(function (Throwable $e) {
        });
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Throwable $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        $status = $this->collectionHandler->getStatusCode($e);

        $error = ['message' => $e->getMessage()];

        if (getenv('APP_ENV') === 'local') {
            $error['trace'] = $e->getTrace();
        }

        return response()->json(
            [
                'error' => $error,
            ],
            $status,
        );
    }
}
