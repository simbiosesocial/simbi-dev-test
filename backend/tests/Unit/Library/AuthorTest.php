<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Author;
use App\Core\Domain\Library\Exceptions\InvalidAuthorName;
use App\Core\Domain\Library\ValueObjects\AuthorName;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function testShouldBeAbleToInstantiateAnAuthor()
    {
        $authorName = new AuthorName("First Name", "Last Name");
        $author = new Author(
            name: $authorName,
        );

        $this->assertIsString($author->id);
        $this->assertEquals("First Name", $author->firstName);
        $this->assertEquals("Last Name", $author->lastName);
    }

    public function testShouldThrowInvalidAuthorName()
    {
        $this->expectException(InvalidAuthorName::class);

        $invalidLastName = '';
        $authorName = new AuthorName("First Name", $invalidLastName);
        new Author(
            name: $authorName,
        );
    }
}
