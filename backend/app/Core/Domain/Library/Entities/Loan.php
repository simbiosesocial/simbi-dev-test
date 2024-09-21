<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use DateTime;

final class Loan extends Entity
{
    /**
     * @var ?string $id
     */
    public ?string $id;
    /**
     * @var ?string $bookId
     */
    public ?string $bookId;
    /**
     * @var ?string $authorId
     */
    public ?string $authorId;
    /**
     * @var ?string $userEmail
     */
    public ?string $userEmail;
    /**
     * @var ?Book $book
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
        ?string $authorId = null,
        ?string $userEmail = null,
        ?DateTime $loanDate = null,
        ?DateTime $returnDate = null,
    ) {
        parent::__construct($id);
        $this->userEmail = $userEmail;
        $this->bookId = $bookId;
        $this->authorId = $authorId;
        $this->loanDate = $loanDate;
        $this->returnDate = $returnDate;
    }
}
