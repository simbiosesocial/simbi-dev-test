<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Exceptions\{LoanMustHaveId};
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoanById\{
    DeleteLoanByIdOutputPort,
    DeleteLoanByIdRequestModel,
    DeleteLoanByIdResponseModel,
    DeleteLoanByIdUseCase,
};
use DateTime;

final class DeleteLoanByIdService implements DeleteLoanByIdUseCase
{
    public function __construct(private DeleteLoanByIdOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    public function execute(DeleteLoanByIdRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $loanId = $requestModel->getLoanId();

        $this->loanRepository->deleteLoanById($loanId);

        return $this->output->present(new DeleteLoanByIdResponseModel($loanId));
    }

    private function validate(DeleteLoanByIdRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanId())) {
            throw new LoanMustHaveId();
        }
    }
}