<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Event\TypeBuiltEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Mailer
{
    /**
     * @var TypeRegistryInterface
     */
    private $typeRegistry;

    /**
     * @var MessageResolverInterface
     */
    private $messageResolver;

    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param TypeRegistryInterface         $typeRegistry
     * @param MessageResolverInterface      $messageResolver
     * @param DriverInterface               $driver
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(
        TypeRegistryInterface $typeRegistry,
        MessageResolverInterface $messageResolver,
        DriverInterface $driver,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->typeRegistry = $typeRegistry;
        $this->messageResolver = $messageResolver;
        $this->driver = $driver;
        $this->eventDispatcher = $eventDispatcher ?: new EventDispatcher();
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return bool
     */
    public function send(string $type, array $options): bool
    {
        $type = $this->typeRegistry->get($type);
        $builder = new MessageBuilder();
        $optionsResolver = new OptionsResolver();

        $type->configureOptions($optionsResolver);

        $options = $optionsResolver->resolve($options);

        $type->buildMessage($builder, $options);

        $this->eventDispatcher->dispatch(Events::EVENT_TYPE_BUILT, new TypeBuiltEvent($type, $builder));

        $message = ResolvedMessage::fromBuilder($builder);

        return $this->driver->send($message);
    }
}
