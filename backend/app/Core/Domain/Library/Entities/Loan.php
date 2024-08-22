<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{InvalidRenewLoan, LoanAlreadyHaveFinished, LoanMustHaveABook, LoanMustHaveAnInitDate, LoanMustHaveAReturnDate, ReturnDateAlreadySet};

use DateTime;

class Loan extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    /**
     * @var array $bookIds
     */
    private array $bookIds = [];

    /**
     * @var ?DateTime $loanDate
     */
    private ?DateTime $loanDate;
    /**
     * @var ?DateTime $returnDate
     */
    private ?DateTime $returnDate;
    /**
     * @var ?DateTime $returnedAt
     */
    private ?DateTime $returnedAt;
    /**
     * @var string $status
     */
    private string $status;
    /**
     * @var array $books
     */
    private array $books = [];
    /**
     * @var int $renewalCount
     */
    private int $renewalCount;
    /**
     * @var ?DateTime $lastRenewedAt
     */
    private ?DateTime $lastRenewedAt;

    const STATUS_CREATED = 'created';
    const STATUS_ACTIVE = 'active';
    const STATUS_FINISHED = 'finished';
    const STATUS_OVERDUE = 'overdue';

    public function __construct(
        ?string $id = null,
        array $bookIds = [],
        ?DateTime $loanDate = null,
        ?DateTime $returnDate = null,
        ?DateTime $returnedAt = null,
        ?string $status = self::STATUS_CREATED,
    ) {
        parent::__construct($id);
        $this->bookIds = $bookIds;
        $this->loanDate = $loanDate ?? new DateTime();
        $this->returnDate = $returnDate;
        $this->status =  $status;
        $this->renewalCount = 0;
        $this->lastRenewedAt = null;
        $this->returnedAt = $returnedAt;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * Add a book to loan
     *
     * @param string $bookId
     * @return void
     */
    public function addBookById(string $bookId): void
    {
        $this->bookIds[] = $bookId;
    }

    /**
     * Remove a book from the loan
     *
     * @param string $bookId
     * @return void
     */
    public function removeBookById(string $bookId): void
    {
        $this->bookIds = array_filter($this->bookIds, fn($id) => $id !== $bookId);
    }

    /**
     * Return the books list from loan
     *
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * Return the return date and status of the loan
     *
     * @return string
     */
    public function getReturnDateAndStatus(): string
    {
        $this->checkOverdue();
        return 'Return date: ' . $this->returnDate . '. Loan status: ' . $this->status;
    }

    public function validate(): void
    {
        $currentDate = new DateTime();

        if (empty($this->loanDate)) {
            throw new LoanMustHaveAnInitDate();
        }

        if (empty($this->returnDate)) {
            throw new LoanMustHaveAReturnDate();
        }

        if (empty($this->bookIds)) {
            throw new LoanMustHaveABook();
        }

        if ($this->returnDate > $currentDate && empty($this->returnedAt)) {
            $this->status = self::STATUS_ACTIVE;
        }

        if ($this->returnedAt) {
            $this->status = self::STATUS_FINISHED;
        }
    }

    /**
     * Sets the return date of the loan.
     *
     * The default loan period is 7 days.
     *
     * @param ?DateTime $returnDate The desired return date. If null, it will be set automatically.
     * @param ?int $days Number of days from the loan date to set the return date, if $returnDate is null. Default is 7 days.
     * @return DateTime The set return date.
     * @throws LoanMustHaveAnInitDate If the loan date is not set.
     */
    public function setReturnDate(?DateTime $returnDate, ?int $days = 7): DateTime
    {
        if (!empty($this->$returnDate)) {
            throw new ReturnDateAlreadySet($this->returnDate);
        }

        $this->status = self::STATUS_ACTIVE;

        if (empty($returnDate)) {
            $this->returnDate = (clone $this->loanDate)->modify("+$days days");
            $this->updatedAt = new DateTime();
            return $this->returnDate;
        }
        $this->returnDate = $returnDate;
        $this->updatedAt = new DateTime();
        return $this->returnDate;
    }

    /**
     * Marks the loan as returned.
     *
     * @param ?DateTime $returnedAt The actual return date. If null, it will be set to the current date.
     * @return void
     */
    public function markAsReturned(?DateTime $returnedAt = null): void
    {
        if ($this->status === self::STATUS_FINISHED) {
            throw new LoanAlreadyHaveFinished($this->returnedAt);
        }
        $this->returnedAt = $returnedAt ?? new DateTime();
        $this->status = self::STATUS_FINISHED;
        $this->updatedAt = new DateTime();
    }

    /**
     * Renews the loan for an additional number of days.
     * *
     * The default renew loan period is 7 days.
     *
     * @param int $additionalDays The number of additional days to renew the loan. Default is 7 days.
     * @return DateTime The new return date after renewal.
     * @throws InvalidRenewLoan If the loan is not active or does not have a return date set.
     */
    public function renewLoan(?int $additionalDays = 7): DateTime
    {
        if ($this->status !== self::STATUS_ACTIVE) {
            throw new InvalidRenewLoan("Only active loans can be renewed.");
        }

        if (empty($this->returnDate)) {
            throw new InvalidRenewLoan("Loan must have a return date to be renewed.");
        }

        $this->returnDate = $this->returnDate->modify("+$additionalDays days");
        $this->renewalCount++;
        $this->lastRenewedAt = new DateTime();
        $this->updatedAt = new DateTime();
        return $this->returnDate;
    }

    public function checkOverdue(): bool
    {
        if (empty($this->returnDate)) {
            throw new LoanMustHaveAReturnDate();
        }

        if ($this->status === self::STATUS_OVERDUE) {
            return true;
        }

        if ($this->status === self::STATUS_FINISHED) {
            return false;
        }

        $currentDate = new DateTime();
        if ($currentDate > $this->returnDate) {
            $this->status = self::STATUS_OVERDUE;
            $this->updatedAt = new DateTime();
            return true;
        }

        return false;
    }
}
