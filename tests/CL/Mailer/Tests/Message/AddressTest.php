<?php

declare(strict_types=1);

namespace CL\Mailer\Tests\Message;

use CL\Mailer\Message\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_contains_an_email_and_optional_name()
    {
        $email = 'johndoe@example.com';
        $name = 'John Doe';
        $address = new Address($email, $name);

        $this->assertSame($email, $address->getEmail());
        $this->assertSame($name, $address->getName());
    }
}
