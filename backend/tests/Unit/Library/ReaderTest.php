<?php

use App\Core\Domain\Library\Entities\Reader;
use App\Core\Domain\Library\ValueObjects\ReaderName;
use App\Core\Domain\Library\ValueObjects\ReaderAddress;
use App\Core\Domain\Library\ValueObjects\ReaderEmail;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    public function test_create_reader_with_valid_parameters()
    {
        $name = new ReaderName('John', 'Doe');
        $address = new ReaderAddress('12345-678', 'S12345');
        $email = new ReaderEmail('john.doe@simbi.com');

        $reader = new Reader(null, $name, $address, $email);

        $this->assertEquals('John', $reader->firstName);
        $this->assertEquals('Doe', $reader->lastName);
        $this->assertEquals($address, $reader->address);
        $this->assertEquals($email, $reader->email);
        $this->assertEmpty($reader->loans);
    }
}