<?php

use App\Adapters\Presenters\Library\DeleteLoanJsonPresenter;
use Tests\TestCase;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoan\DeleteLoanRequestModel;
use App\Core\Services\Library\DeleteLoanService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class DeleteLoanByIdUseCaseTest extends TestCase
{
    public function test_should_delete_a_loan()
    {
        $loan = Loan::factory()->create();

        $loanRepository = new LoanEloquentRepository();
        $loanPresenter = new DeleteLoanJsonPresenter();
        $requestModel = new DeleteLoanRequestModel([
            "loan_id" => $loan->id
        ]);

        $service = new DeleteLoanService($loanPresenter, $loanRepository);
        $result = $service->execute($requestModel);

        $this->assertInstanceOf(ViewModel::class, $result);
        $this->assertArrayHasKey('id', $result->getResponse()->toArray());
    }
}