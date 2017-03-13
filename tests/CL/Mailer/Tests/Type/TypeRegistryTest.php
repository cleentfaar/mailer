<?php

namespace CL\Mailer\Tests\Type;

use CL\Mailer\Type\TypeInterface;
use CL\Mailer\Type\TypeRegistry;
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
