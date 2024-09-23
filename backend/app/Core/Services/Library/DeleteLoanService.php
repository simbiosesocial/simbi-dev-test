<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Exceptions\{LoanMustHaveId};
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoan\{
    DeleteLoanOutputPort,
    DeleteLoanRequestModel,
    DeleteLoanResponseModel,
    DeleteLoanUseCase,
};
use DateTime;

final class DeleteLoanService implements DeleteLoanUseCase
{
    public function __construct(private DeleteLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    public function execute(DeleteLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $loanId = $requestModel->getLoanId();

        $this->loanRepository->deleteLoan($loanId);

        return $this->output->present(new DeleteLoanResponseModel($loanId));
    }

    private function validate(DeleteLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanId())) {
            throw new LoanMustHaveId();
        }
    }
}