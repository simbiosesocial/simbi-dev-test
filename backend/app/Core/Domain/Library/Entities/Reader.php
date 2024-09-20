<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Domain\Library\ValueObjects as VO;

final class Reader extends Entity
{
    /**
     * @var string $firstName
     */
    public string $firstName;
    /**
     * @var string $lastNamee
     */
    public string $lastName;
    /**
     * @var VO\ReaderName $loanerName
     */
    public VO\ReaderName $loanerName;
    /**
     * @var VO\ReaderAddress $address
     */
    public VO\ReaderAddress $address;
    /**
     * @var Vo\ReaderEmail $email
     */
    public VO\ReaderEmail $email;

    /**
     * @var BookLoan[] $loans
     */
    public mixed $loans;

    /**
     * @param ?string $id
     * @param ?ReaderName $name
     * @param ?VO\ReaderAddress $address,
     * @param ?VO\ReaderEmail $email,
     */
    public function __construct(
        ?string $id = null,
        ?VO\ReaderName $name = null,
        ?VO\ReaderAddress $address = null,
        ?VO\ReaderEmail $email = null,
    ) {
        parent::__construct($id);
        $this->firstName = $name->firstName;
        $this->lastName = $name->lastName;
        $this->address = $address;
        $this->email = $email;

        $this->loans = [];
    }

    public function addLoan(Loan $loan): void
    {
        $this->loans[] = $loan;
    }
}