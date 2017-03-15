<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\TypeInterface;
use CL\Mailer\TypeRegistry;
use PHPUnit\Framework\TestCase;

class TypeRegistryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_register_and_return_mail_types()
    {
        $typeRegistry = new TypeRegistry();

        $type = $this->prophesize(TypeInterface::class)->reveal();

        $typeRegistry->register($type);

        $this->assertSame($type, $typeRegistry->get(get_class($type)));
    }
}
