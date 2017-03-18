<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Mailer;
use CL\Mailer\ResolvedMessageInterface;
use CL\Mailer\Test\Driver\InMemoryDriver;
use CL\Mailer\TypeInterface;
use CL\Mailer\TypeRegistryInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class MailerTest extends TestCase
{
    const TYPE = 'my_type';

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var InMemoryDriver
     */
    private $driver;

    /**
     * @var ObjectProphecy|TypeRegistryInterface
     */
    private $typeRegistry;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->typeRegistry = $this->prophesize(TypeRegistryInterface::class);
        $this->driver = new InMemoryDriver();

        $this->mailer = new Mailer(
            $this->typeRegistry->reveal(),
            $this->driver
        );
    }

    /**
     * @test
     */
    public function it_can_send_a_message_by_type()
    {
        $type = $this->prophesize(TypeInterface::class);
        $options = [];

        $this->typeRegistry->get(self::TYPE)->willReturn($type);

        $this->mailer->send(self::TYPE, $options);

        $messages = $this->driver->getMessagesSent();

        self::assertCount(1, $messages);
        self::assertInstanceOf(ResolvedMessageInterface::class, $messages[0]);
    }
}
