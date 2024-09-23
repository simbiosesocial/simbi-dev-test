<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\{
    ListAllLoansOutputPort,
    ListAllLoansResponseModel,
    ListAllLoansUseCase,
};

final class ListAllLoansService implements ListAllLoansUseCase
{
    public function __construct(private ListAllLoansOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    public function execute(): ViewModel
    {
        $loans = $this->loanRepository->getAll();
        return $this->output->present(new ListAllLoansResponseModel($loans));
    }
}
