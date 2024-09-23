<?php

use App\Core\Domain\Library\Entities\User;
use App\Core\Domain\Library\ValueObjects\UserName;
use App\Core\Domain\Library\ValueObjects\UserAddress;
use App\Core\Domain\Library\ValueObjects\UserEmail;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_create_User()
    {
        $name = new UserName('Test', 'User');
        $address = new UserAddress('12345-678', '123');
        $email = new UserEmail('TestUser1997@simbi.com');

        $User = new User(null, $name, $address, $email);

        $this->assertEquals('Test', $User->firstName);
        $this->assertEquals('User', $User->lastName);
        $this->assertEquals($address, $User->address);
        $this->assertEquals($email, $User->email);
        $this->assertEmpty($User->loans);

        //dd($User);
    }
}