<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testShouldBeAbleToInstantiateABook()
    {
        $book = new Book(title: "Título teste", publisher: "Editora teste", authorId: "123");

        $this->assertIsString($book->id);
        $this->assertEquals("Título teste", $book->title);
        $this->assertEquals("Editora teste", $book->publisher);
        $this->assertEquals("123", $book->authorId);
    }
}
