<?php

use App\Adapters\Presenters\Library\DeleteLoanByIdJsonPresenter;
use Tests\TestCase;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoanById\DeleteLoanByIdRequestModel;
use App\Core\Services\Library\DeleteLoanByIdService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class DeleteLoanByIdUseCaseTest extends TestCase
{
    public function test_should_delete_a_loan()
    {
        $loan = Loan::factory()->create();

        $loanRepository = new LoanEloquentRepository();
        $loanPresenter = new DeleteLoanByIdJsonPresenter();
        $requestModel = new DeleteLoanByIdRequestModel([
            "loan_id" => $loan->id
        ]);

        $service = new DeleteLoanByIdService($loanPresenter, $loanRepository);
        $result = $service->execute($requestModel);

        $this->assertInstanceOf(ViewModel::class, $result);
        $this->assertArrayHasKey('id', $result->getResponse()->toArray());
    }
}
