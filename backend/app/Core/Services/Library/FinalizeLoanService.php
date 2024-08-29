<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanIdIsRequired;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
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
    public function __construct(
        private FinalizeLoanOutputPort $output,
        private LoanRepository $loanRepository,
        private BookRepository $bookRepository
        )
    {
    }
    /**
     * @param FinalizeLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(FinalizeLoanRequestModel $requestModel): ViewModel
    {
        $loanId = $requestModel->getLoanId();
        $this->validate($loanId);

        $status = 'finished';
        $returnedAt = new DateTime();

        $loan = $this->loanRepository->finalize($loanId, $status, $returnedAt->format('Y-m-d H:i:s'));
        $this->bookRepository->setAvailable($loan->bookId, true);

        return $this->output->present(new FinalizeLoanResponseModel($loan));
    }

    /**
     * @param string $loanId
     *
     * @return void
     */
    private function validate(?string $loanId): void
    {
        if (empty($loanId)) {
            throw new LoanIdIsRequired();
        }

        $loan = $this->loanRepository->findById($loanId);
        if ($loan->status === 'finished') {
            throw new LoanAlreadyHaveFinished($loan->returnedAt);
        }
    }
}
