<?php

use App\Core\Domain\Library\Exceptions\InvalidReaderAddress;
use App\Core\Domain\Library\ValueObjects\ReaderAddress;
use PHPUnit\Framework\TestCase;

class ReaderAddressTest extends TestCase
{
    public function test_create_reader_address_with_valid_zipcode_and_housenumber()
    {
        $zipCode = '12 345-678';
        $houseNumber = '123A';

        $readerAddress = new ReaderAddress($zipCode, $houseNumber);

        $this->assertEquals('12345678', $readerAddress->zipCode);
        $this->assertEquals('123A', $readerAddress->houseNumber);
    }

    public function test_create_reader_address_with_invalid_zipcode()
    {
        $this->expectException(InvalidReaderAddress::class);

        $zipCode = 'wrong123456789';
        $houseNumber = '123A';

        new ReaderAddress($zipCode, $houseNumber);
    }
}
