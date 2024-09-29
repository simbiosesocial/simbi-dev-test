<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use App\Core\Domain\Library\Exceptions\InvalidAuthorName;
use App\Core\Domain\Library\Exceptions\LoanMustHaveAnBook;
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

    public function testShouldCreateLoan()
    {
        $request = new CreateLoanRequestModel([
            "bookId" => "123",
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan->id);
        $this->assertEquals("123", $loan->bookId);
    }

    public function testShouldThrowInvalidBook()
    {
        $request = new CreateLoanRequestModel([
            "bookId" => null,
        ]);

        $this->expectException(LoanMustHaveAnBook::class);
        $this->useCase->execute($request);
    }
}
