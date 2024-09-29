<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{LoanMustHaveADueDate, LoanMustHaveALoanDate, LoanMustHaveAnBook, LoanMustHaveAStatus};
use DateTime;

final class Loan extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    /**
     * @var ?string $id
     */
    public ?string $id;
    /**
     * @var ?string $bookId
     */
    public ?string $bookId;
    /**
     * @var ?string $loanDate
     */
    public ?string $loanDate;
    /**
     * @var ?string $dueDate
     */
    public ?string $dueDate;
    /**
     * @var ?string $returnDate
     */
    public ?string $returnDate;
    /**
     * @var ?string $status
     */
    public ?string $status;
    /**
     * @var ?Book $author
     */
    public ?Book $book;

    /**
     * @param ?string $id
     * @param ?string $title
     * @param ?string $publisher
     * @param ?string $authorId
     */
    public function __construct(
        ?string $id = null,
        ?string $bookId = null,
        ?string $loanDate = null,
        ?string $dueDate = null,
        ?string $returnDate = null,
        ?string $status = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
    ) {
        parent::__construct($id);
        $this->bookId = $bookId;
        $this->loanDate = $loanDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    /**
     * @param Book $book
     *
     * @return void
     */
    public function addBook(Book $book): void
    {
        $this->book = $book;
    }

    /**
     * @return void
     */
    public function validate(): void
    {
        if (empty($this->bookId)) {
            throw new LoanMustHaveAnBook();
        }

        if (empty($this->loanDate)) {
            throw new LoanMustHaveALoanDate();
        }

        if (empty($this->dueDate)) {
            throw new LoanMustHaveADueDate();
        }

        if (empty($this->status)) {
            throw new LoanMustHaveAStatus();
        }
    }
}
