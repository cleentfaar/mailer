<?php

declare(strict_types=1);

namespace CL\Mailer;

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
     * @param TypeRegistryInterface         $typeRegistry
     * @param DriverInterface               $driver
     */
    public function __construct(
        TypeRegistryInterface $typeRegistry,
        DriverInterface $driver
    ) {
        $this->typeRegistry = $typeRegistry;
        $this->driver = $driver;
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return bool
     */
    public function send(string $type, array $options = []): bool
    {
        $type = $this->typeRegistry->get($type);
        $builder = MessageBuilder::fromType($type, $options);
        $message = ResolvedMessage::fromBuilder($builder);

        return $this->driver->send($message);
    }
}
