<?php

use App\Core\Domain\Library\Exceptions\InvalidReaderName;
use App\Core\Domain\Library\ValueObjects\ReaderName;
use PHPUnit\Framework\TestCase;

class ReaderNameTest extends TestCase
{
    public function test_should_reader_name_initializes()
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $readerName = new ReaderName($firstName, $lastName);

        $this->assertEquals($firstName, $readerName->firstName);
        $this->assertEquals($lastName, $readerName->lastName);
    }

    public function test_reader_name_null_first_name_throws_exception()
    {
        $this->expectException(InvalidReaderName::class);

        $firstName = null;
        $lastName = 'Doe';

        new ReaderName($firstName, $lastName);
    }
}