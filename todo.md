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