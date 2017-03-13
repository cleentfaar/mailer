<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Driver\DriverInterface;
use CL\Mailer\Mailer;
use CL\Mailer\Message\MessageHeaderInterface;
use CL\Mailer\Type\TypeInterface;
use CL\Mailer\Type\TypeRegistry;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailerTest extends TestCase
{
    const TYPE = 'my_type';

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var ObjectProphecy|TypeRegistry
     */
    private $typeRegistry;

    /**
     * @var ObjectProphecy|DriverInterface
     */
    private $driver;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->typeRegistry = $this->prophesize(TypeRegistry::class);
        $this->driver = $this->prophesize(DriverInterface::class);

        $this->mailer = new Mailer(
            $this->typeRegistry->reveal(),
            $this->driver->reveal()
        );
    }

    /**
     * @test
     */
    public function it_can_send_a_message_by_type()
    {
        $options = ['foo' => 'bar'];

        $type = $this->prophesize(TypeInterface::class);
        $type->buildMessage(Argument::type(MessageHeaderInterface::class), $options)
            ->shouldBeCalledTimes(1)
        ;

        $type->configureOptions(Argument::type(OptionsResolver::class))
            ->shouldBeCalledTimes(1)
        ;

        $this->typeRegistry->get(self::TYPE)
            ->shouldBeCalledTimes(1)
            ->willReturn($type)
        ;

        $this->driver->send(Argument::type(MessageHeaderInterface::class))
            ->shouldBeCalledTimes(1)
            ->willReturn(true)
        ;

        $this->assertTrue($this->mailer->send(self::TYPE, $options));
    }
}
