<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\MessageResolver;
use CL\Mailer\MessageResolverInterface;
use CL\Mailer\ResolvedMessage;
use CL\Mailer\TypeInterface;
use CL\Mailer\TypeRegistry;
use CL\Mailer\TypeRegistryInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class MessageResolverTest extends TestCase
{
    const MAILER_TYPE = 'my_mailer';

    /**
     * @var MessageResolverInterface
     */
    private $resolver;

    /**
     * @var ObjectProphecy|TypeRegistryInterface
     */
    private $registry;

    /**
     * @var ObjectProphecy|TranslatorInterface
     */
    private $translator;

    /**
     * @var ObjectProphecy|EngineInterface
     */
    private $templating;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->registry = $this->prophesize(TypeRegistry::class);
        $this->translator = $this->prophesize(TranslatorInterface::class);
        $this->templating = $this->prophesize(EngineInterface::class);
        $this->resolver = new MessageResolver(
            $this->registry->reveal(),
            $this->translator->reveal(),
            $this->templating->reveal()
        );
    }

    /**
     * @test
     */
    public function it_can_resolve_a_message_from_the_given_type_and_options()
    {
        $type = self::MAILER_TYPE;
        $mailer = $this->prophesize(TypeInterface::class)->reveal();

        $this->registry->get(self::MAILER_TYPE)->shouldBeCalledTimes(1)->willReturn($mailer);

        $resolvedMessage = $this->resolver->resolve($type, []);

        $this->assertInstanceOf(ResolvedMessage::class, $resolvedMessage);
    }
}
