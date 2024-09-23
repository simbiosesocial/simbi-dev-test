<?php

namespace App\Providers;

use App\Adapters\Presenters\Library\CreateAuthorJsonPresenter;
use App\Adapters\Presenters\Library\CreateBookJsonPresenter;
use App\Adapters\Presenters\Library\ListAllBooksJsonPresenter;
use App\Adapters\Presenters\Library\ListBooksByAuthorJsonPresenter;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\CreateAuthorUseCase;
use App\Core\Domain\Library\Ports\UseCases\CreateBook\CreateBookUseCase;
use App\Core\Domain\Library\Ports\UseCases\ListAllBooks\ListAllBooksUseCase;
use App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor\ListBooksByAuthorUseCase;
use App\Core\Services\Library\CreateAuthorService;
use App\Core\Services\Library\CreateBookService;
use App\Core\Services\Library\ListAllBooksService;
use App\Core\Services\Library\ListBooksByAuthorService;
use App\Http\Controllers\CreateAuthorController;
use App\Http\Controllers\CreateBookController;
use App\Http\Controllers\ListAllBooksController;
use App\Http\Controllers\ListBooksByAuthorController;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\AuthorEloquentRepository;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\BookEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use App\Adapters\Presenters\Library\DeleteLoanJsonPresenter;
use App\Adapters\Presenters\Library\ListAllLoansJsonPresenter;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanUseCase;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoan\DeleteLoanUseCase;
use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\ListAllLoansUseCase;
use App\Core\Services\Library\CreateLoanService;
use App\Core\Services\Library\DeleteLoanService;
use App\Core\Services\Library\ListAllLoansService;
use App\Http\Controllers\CreateLoanController;
use App\Http\Controllers\DeleteLoanController;
use App\Http\Controllers\ListAllLoansController;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
        $this->bindDefaultDependencies();
        $this->libraryDependencies();
    }

    public function bindDefaultDependencies()
    {
        /**
         * Example bindings
         */
        $this->app->bind(AuthorRepository::class, AuthorEloquentRepository::class);
        $this->app->bind(LoanRepository::class, LoanEloquentRepository::class);
        $this->app->bind(BookRepository::class, BookEloquentRepository::class);
    }

    /**
     * The following bindings is project examples, remove to start your project
     */
    public function libraryDependencies()
    {
        $this->app
            ->when(CreateAuthorController::class)
            ->needs(CreateAuthorUseCase::class)
            ->give(
                fn($app) => $app->make(CreateAuthorService::class, [
                    "output" => $app->make(CreateAuthorJsonPresenter::class),
                ]),
            );

        $this->app
            ->when(CreateBookController::class)
            ->needs(CreateBookUseCase::class)
            ->give(
                fn($app) => $app->make(CreateBookService::class, [
                    "output" => $app->make(CreateBookJsonPresenter::class),
                ]),
            );

        $this->app
            ->when(ListAllBooksController::class)
            ->needs(ListAllBooksUseCase::class)
            ->give(
                fn($app) => $app->make(ListAllBooksService::class, [
                    "output" => $app->make(ListAllBooksJsonPresenter::class),
                ]),
            );

        $this->app
            ->when(ListBooksByAuthorController::class)
            ->needs(ListBooksByAuthorUseCase::class)
            ->give(
                fn($app) => $app->make(ListBooksByAuthorService::class, [
                    "output" => $app->make(ListBooksByAuthorJsonPresenter::class),
                ]),
            );
            $this->app
            ->when(CreateLoanController::class)
            ->needs(CreateLoanUseCase::class)
            ->give(
                fn($app) => $app->make(CreateLoanService::class, [
                    "output" => $app->make(CreateLoanJsonPresenter::class),
                ]),
            );

        $this->app
            ->when(ListAllLoansController::class)
            ->needs(ListAllLoansUseCase::class)
            ->give(
                fn($app) => $app->make(ListAllLoansService::class, [
                    "output" => $app->make(ListAllLoansJsonPresenter::class),
                ]),
            );

        $this->app
            ->when(DeleteLoanController::class)
            ->needs(DeleteLoanUseCase::class)
            ->give(
                fn($app) => $app->make(DeleteLoanService::class, [
                    "output" => $app->make(DeleteLoanJsonPresenter::class),
                ]),
            );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
