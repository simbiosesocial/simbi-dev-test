<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanUseCase;
use App\Core\Services\Library\CreateLoanService;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLoanUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateLoanUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateLoanService(
            output: new CreateLoanJsonPresenter(),
            loanRepository: new LoanEloquentRepository(),
        );
    }

    public function testShouldCreateALoan()
    {
        $request = new CreateLoanRequestModel([
            "bookId" => "book_id_1234",
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan->id);
        $this->assertEquals("book_id_1234", $loan->book->id);
    }

    public function testShouldThrowLoanMustHaveABook()
    {

        $request = new CreateLoanRequestModel([
            "bookId" => "",
        ]);

        $this->expectException(LoanMustHaveABook::class);
        $loan = $this->useCase->execute($request);
    }

}
