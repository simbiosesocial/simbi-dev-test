<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{LoanMustHaveABook, LoanMustHaveAnInitDate, LoanMustHaveAReturnDate};

use DateTime;

class Loan extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    /**
     * @var ?string $bookId
     */
    public ?string $bookId;
    /**
     * @var ?DateTime $loanDate
     */
    public ?DateTime $loanDate;
    /**
     * @var ?DateTime $returnDate
     */
    public ?DateTime $returnDate;
    /**
     * @var ?DateTime $returnedAt
     */
    public ?DateTime $returnedAt;
    /**
     * @var string $status
     */
    public string $status;
    /**
     * @var ?Book $book
     */
    public ?Book $book;
    /**
     * @var int $renewalCount
     */
    public int $renewalCount;
    /**
     * @var ?DateTime $lastRenewedAt
     */
    public ?DateTime $lastRenewedAt;

    const STATUS_CREATED = 'created';
    const STATUS_ACTIVE = 'active';
    const STATUS_FINISHED = 'finished';
    const STATUS_OVERDUE = 'overdue';

    public function __construct(
        ?string $id = null,
        ?string $bookId = null,
        ?DateTime $loanDate = null,
        ?DateTime $returnDate = null,
        ?DateTime $returnedAt = null,
        ?int $renewalCount = 0,
        ?DateTime $lastRenewedAt = null,
        ?string $status = self::STATUS_CREATED,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
    ) {
        parent::__construct($id);
        $this->bookId = $bookId;
        $this->loanDate = $loanDate ?? new DateTime();
        $this->returnDate = $returnDate;
        $this->status = $status;
        $this->renewalCount = $renewalCount;
        $this->lastRenewedAt = $lastRenewedAt;
        $this->returnedAt = $returnedAt;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt;

        $this->validate();
    }

    /**
     * Add a book to loan
     *
     * @param Book $book
     * @return void
     */
    public function addBook(Book $book): void
    {
        $this->book = $book;
    }

    public function validate(): void
    {
        $currentDate = new DateTime();

        if (empty($this->bookId)) {
            throw new LoanMustHaveABook();
        }

        if (empty($this->returnDate)) {
            throw new LoanMustHaveAReturnDate();
        }

        if (empty($this->returnedAt)) {
            if ($this->returnDate < $currentDate) {
                $this->status = self::STATUS_OVERDUE;
            } else {
                $this->status = self::STATUS_ACTIVE;
            }
        } else {
            $this->status = self::STATUS_FINISHED;
        }
        $this->updatedAt = new DateTime();
    }
}
