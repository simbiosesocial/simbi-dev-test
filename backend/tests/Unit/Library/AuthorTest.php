<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Author;
use App\Core\Domain\Library\Exceptions\InvalidAuthorName;
use App\Core\Domain\Library\ValueObjects\AuthorName;
use PHPUnit\Framework\TestCase;
use DateTime;

class AuthorTest extends TestCase
{
    public function testShouldBeAbleToInstantiateAnAuhtor()
    {
        $name = new AuthorName('John', 'Doe');
        $createdAt = new DateTime('2023-01-01');
        $updatedAt = new DateTime('2023-01-02');
        $author = new Author('1', $name, $createdAt, $updatedAt);

        $this->assertEquals('John', $author->firstName);
        $this->assertEquals('Doe', $author->lastName);
        $this->assertEquals($createdAt, $author->createdAt);
        $this->assertEquals($updatedAt, $author->updatedAt);
    }

    public function testShouldThrowInvalidAuthorName()
    {
        $this->expectException(InvalidAuthorName::class);
        new AuthorName('John');
    }
}
