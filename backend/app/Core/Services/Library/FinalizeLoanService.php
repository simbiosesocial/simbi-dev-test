<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanIdIsRequired;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\{
    FinalizeLoanOutputPort,
    FinalizeLoanRequestModel,
    FinalizeLoanResponseModel,
    FinalizeLoanUseCase,
};
use DateTime;

final class FinalizeLoanService implements FinalizeLoanUseCase
{
    /**
     * @param FinalizeLoanOutputPort $output
     * @param LoanRepository $loanRepository
     */
    public function __construct(private FinalizeLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }
    /**
     * @param FinalizeLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(FinalizeLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $id = $requestModel->getLoanId();
        $loan = $this->loanRepository->findById($id);

        $this->validateLoanStatus($loan);

        $status = 'finished';
        $returnedAt = new DateTime();

        $loan = $this->loanRepository->finalize($id, $status, $returnedAt->format('Y-m-d H:i:s'));
        return $this->output->present(new FinalizeLoanResponseModel($loan));
    }

    /**
     * @param FinalizeLoanRequestModel $requestModel
     *
     * @return void
     */
    private function validate(FinalizeLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanId())) {
            throw new LoanIdIsRequired();
        }
    }

    /**
     * @param Loan $loan
     *
     * @return void
     */
    private function validateLoanStatus(Loan $loan): void
    {
        if ($loan->status === 'finished') {
            throw new LoanAlreadyHaveFinished($loan->returnedAt);
        }
    }
}
