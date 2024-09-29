<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveAnBook;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{
    CreateLoanOutputPort,
    CreateLoanRequestModel,
    CreateLoanResponseModel,
    CreateLoanUseCase,
};

final class CreateLoanService implements CreateLoanUseCase
{
    /**
     * @param CreateLoanOutputPort $output
     */
    public function __construct(private CreateLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $loan = $this->loanRepository->create(
            new Loan(
                bookId: $requestModel->getBookId(),
                loanDate: now(),
                dueDate: now()->addDays(15),
                status: 'active',
            ),
        );

        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return void
     */
    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new LoanMustHaveAnBook();
        }
    }
}
