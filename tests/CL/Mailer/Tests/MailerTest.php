<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Driver\DriverInterface;
use CL\Mailer\Mailer;
use CL\Mailer\MessageResolver;
use CL\Mailer\MessageResolverInterface;
use CL\Mailer\ResolvedMessageInterface;
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
     * @var ObjectProphecy|MessageResolverInterface
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
    public function it_can_send_a_message_by_type_and_return_driver_result()
    {
        $options = ['foo' => 'bar'];
        $result = true;

        $resolvedMessage = $this->prophesize(ResolvedMessageInterface::class);

        $this->messageResolver->resolve(self::TYPE, $options)
            ->shouldBeCalledTimes(1)
            ->willReturn($resolvedMessage)
        ;

        $this->driver->send($resolvedMessage)
            ->shouldBeCalledTimes(1)
            ->willReturn($result)
        ;

        $this->assertSame($result, $this->mailer->send(self::TYPE, $options));
    }
}
