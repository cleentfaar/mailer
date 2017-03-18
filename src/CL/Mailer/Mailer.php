<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Event\TypeBuiltEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Mailer
{
    /**
     * @var TypeRegistryInterface
     */
    private $typeRegistry;

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
     * @param DriverInterface               $driver
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(
        TypeRegistryInterface $typeRegistry,
        DriverInterface $driver,
        EventDispatcherInterface $eventDispatcher = null
    ) {
        $this->typeRegistry = $typeRegistry;
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
        $builder = MessageBuilder::fromType($type, $options);

        $this->eventDispatcher->dispatch(Events::EVENT_TYPE_BUILT, new TypeBuiltEvent($type, $builder));

        $message = ResolvedMessage::fromBuilder($builder);

        return $this->driver->send($message);
    }
}
