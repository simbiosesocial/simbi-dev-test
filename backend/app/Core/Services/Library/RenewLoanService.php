<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanIdIsRequired;
use App\Core\Domain\Library\Exceptions\LoanNotFound;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\RenewLoan\{
    RenewLoanOutputPort,
    RenewLoanRequestModel,
    RenewLoanResponseModel,
    RenewLoanUseCase,
};
use DateTime;

final class RenewLoanService implements RenewLoanUseCase
{
    /**
     * @param RenewLoanOutputPort $output
     * @param LoanRepository $loanRepository
     */
    public function __construct(private RenewLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    /**
     * @param RenewLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(RenewLoanRequestModel $requestModel): ViewModel
    {
        $id = $requestModel->getLoanId();
        $this->validate($id);

        $lastRenewedAt = new DateTime();
        $returnDate = (clone $lastRenewedAt)->modify('+7 days');

        $loan = $this->loanRepository->renew(
            $id,
            $lastRenewedAt->format(DateTime::ATOM),
            $returnDate->format(DateTime::ATOM)
        );
        return $this->output->present(new RenewLoanResponseModel($loan));
    }

    /**
     * @param ?string $loanId
     *
     * @return void
     */
    private function validate(?string $loanId): void
    {
        if (empty($loanId)) {
            throw new LoanIdIsRequired();
        }
        $loan = $this->loanRepository->findById($loanId);
        if (empty($loan)) {
            throw new LoanNotFound();
        }
        if ($loan->status === 'finished') {
            throw new LoanAlreadyHaveFinished($loan->returnedAt);
        }
    }
}
