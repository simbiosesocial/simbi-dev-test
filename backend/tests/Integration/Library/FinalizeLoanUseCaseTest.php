<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\FinalizeLoanJsonPresenter;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanNotFound;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\FinalizeLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\FinalizeLoanUseCase;
use App\Core\Services\Library\FinalizeLoanService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class FinalizeLoanUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private FinalizeLoanUseCase $useCase;

    private Loan $loan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new FinalizeLoanService(
            output: new FinalizeLoanJsonPresenter(),
            loanRepository: new LoanEloquentRepository()
        );
        $this->loan = Loan::where([ 'status' => 'active', 'returned_at' => null])->first() ?? Loan::factory()->create(['status' => 'active', 'returned_at' => null]);
    }

    public function testShouldFinalizeALoan()
    {
        $request = new FinalizeLoanRequestModel([
            "loanId" => $this->loan->id,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $today = new DateTime('now');
        $returnedAt = new DateTime($loan['returnedAt']);

        $this->assertIsString($loan['id']);
        $this->assertEquals('finished', $loan['status']);
        $this->assertEquals(true, $loan['book']['isAvailable']);

        $this->assertArrayHasKey('returnedAt', $loan);
        $this->assertEquals($today->format('Y-m-d'), $returnedAt->format('Y-m-d'));
    }


    public function testShouldThrowLoanNotFound()
    {
        $invalidLoanId = Uuid::uuid4();
        $request = new FinalizeLoanRequestModel([
            "loanId" => $invalidLoanId
        ]);

        $this->expectException(LoanNotFound::class);
        $this->useCase->execute($request);
    }

    public function testShouldThrowLoanAlreadyHaveFinished()
    {
        $today = new DateTime('now');
        $returnedAt = $today->format(DateTime::ATOM);

        $loanEloquent = new LoanEloquentRepository();
        $loanEloquent->finalize($this->loan->id, $returnedAt);

        $request = new FinalizeLoanRequestModel([
            "loanId" => $this->loan->id,
        ]);

        $this->expectException(LoanAlreadyHaveFinished::class);
        $this->useCase->execute($request);
    }

}
