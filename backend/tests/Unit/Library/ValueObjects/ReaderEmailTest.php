<?php

use App\Core\Domain\Library\ValueObjects\ReaderEmail;
use PHPUnit\Framework\TestCase;
use App\Core\Domain\Library\Exceptions\InvalidReaderEmail;

class ReaderEmailTest extends TestCase
{
    public function test_should_create_reader_email_with_valid_email()
    {
        $email = 'myfakevalidemail@simbi.com';
        $readerEmail = new ReaderEmail($email);
        $this->assertEquals($email, $readerEmail->email);
    }

    public function test_should_fail_reader_email_with_empty_string()
    {
        $this->expectException(InvalidReaderEmail::class);
        new ReaderEmail('');
    }

    public function test_should_fail_reader_email_invalid()
    {
        $this->expectException(InvalidReaderEmail::class);
        new ReaderEmail('some random string');
    }
}
