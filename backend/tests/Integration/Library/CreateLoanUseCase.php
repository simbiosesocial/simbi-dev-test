<?php

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use Tests\TestCase;
use App\Core\Services\Library\CreateLoanService;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanRequestModel;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\BookEloquentRepository;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class CreateLoanUseCase extends TestCase
{
    public function test_should_create_a_loan()
    {

        $book = Book::factory()->create();

        $bookRepository = new BookEloquentRepository();
        $loanRepository = new LoanEloquentRepository();
        $loanPresenter = new CreateLoanJsonPresenter(); 
        $requestModel = new CreateLoanRequestModel([
            "book_id" => $book->id,
            "loan_date" => "2024-04-11",
            "return_date" => "2024-04-17",
        ]);

        $service = new CreateLoanService($loanPresenter, $bookRepository, $loanRepository);
        $result = $service->execute($requestModel);

        $this->assertInstanceOf(ViewModel::class, $result);
        $this->assertArrayHasKey('loaned_book', $result->getResponse()->toArray());
        $this->assertArrayHasKey('loan_date', $result->getResponse()->toArray());
        $this->assertArrayHasKey('return_date', $result->getResponse()->toArray());
    }
}