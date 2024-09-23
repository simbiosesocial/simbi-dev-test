<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Domain\Library\ValueObjects as VO;

final class User extends Entity
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
     * @var VO\UserName $loanerName
     */
    public VO\UserName $loanerName;
    /**
     * @var VO\UserAddress $address
     */
    public VO\UserAddress $address;
    /**
     * @var Vo\UserEmail $email
     */
    public VO\UserEmail $email;

    /**
     * @var BookLoan[] $loans
     */
    public mixed $loans;

    /**
     * @param ?string $id
     * @param ?UserName $name
     * @param ?VO\UserAddress $address,
     * @param ?VO\UserEmail $email,
     */
    public function __construct(
        ?string $id = null,
        ?VO\UserName $name = null,
        ?VO\UserAddress $address = null,
        ?VO\UserEmail $email = null,
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
