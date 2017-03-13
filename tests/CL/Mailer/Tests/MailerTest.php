<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Driver\DriverInterface;
use CL\Mailer\Mailer;
use CL\Mailer\Message\MessageHeaderInterface;
use CL\Mailer\Message\MessageResolver;
use CL\Mailer\Message\ResolvedMessage;
use CL\Mailer\Type\TypeInterface;
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
     * @var ObjectProphecy|MessageResolver
     */
    private $messageResolver;

    /**
     * @var ObjectProphecy|DriverInterface
     */
    private $driver;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->messageResolver = $this->prophesize(MessageResolver::class);
        $this->driver = $this->prophesize(DriverInterface::class);

        $this->mailer = new Mailer(
            $this->messageResolver->reveal(),
            $this->driver->reveal()
        );
    }

    /**
     * @test
     */
    public function it_can_send_a_message_by_type()
    {
        $options = ['foo' => 'bar'];

        $resolvedMessage = $this->prophesize(ResolvedMessage::class);

        $this->messageResolver->resolve(self::TYPE, $options)
            ->shouldBeCalledTimes(1)
            ->willReturn($resolvedMessage)
        ;

        $this->driver->send($resolvedMessage)
            ->shouldBeCalledTimes(1)
            ->willReturn(true)
        ;

        $this->assertTrue($this->mailer->send(self::TYPE, $options));
    }
}
