<?php

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use Tests\TestCase;
use App\Core\Services\Library\CreateLoanService;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanRequestModel;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\BookEloquentRepository;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class CreateLoanUseCaseTest extends TestCase
{
    public function test_should_create_a_loan()
    {

        $book = Book::factory()->create();

        $bookRepository = new BookEloquentRepository();
        $loanRepository = new LoanEloquentRepository();
        $loanPresenter = new CreateLoanJsonPresenter(); # outputPort
        $requestModel = new CreateLoanRequestModel([
            "book_id" => $book->id,
            "start_loan_date" => "2024-08-24",
            "end_loan_date" => "2024-08-30",
        ]);

        $service = new CreateLoanService($loanPresenter, $bookRepository, $loanRepository);
        $result = $service->execute($requestModel);

        $this->assertInstanceOf(ViewModel::class, $result);
        $this->assertArrayHasKey('loaned_book', $result->getResponse()->toArray());
        $this->assertArrayHasKey('start_loan_date', $result->getResponse()->toArray());
        $this->assertArrayHasKey('end_loan_date', $result->getResponse()->toArray());
    }
}
