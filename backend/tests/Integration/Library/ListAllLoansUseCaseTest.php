<?php

use App\Adapters\Presenters\Library\ListAllLoansJsonPresenter;
use Tests\TestCase;
use App\Core\Common\Ports\ViewModel;
use App\Core\Services\Library\ListAllLoansService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;

class ListAllLoansUseCaseTest extends TestCase
{
    public function test_should_loans()
    {
        $numberOfExpectedEntriesOnDB = 3;
        Loan::truncate();
        Loan::factory()->count($numberOfExpectedEntriesOnDB)->create();

        $loanRepo = new LoanEloquentRepository();
        $viewModel = new ListAllLoansJsonPresenter();
        $usecase = new ListAllLoansService($viewModel, $loanRepo);

        $loansList = $usecase->execute();
        $loansListResponse = $loansList->getResponse();

        $this->assertCount($numberOfExpectedEntriesOnDB, $loansListResponse);
    }
}