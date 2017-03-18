<?php

declare(strict_types=1);

namespace CL\Mailer;

use OutOfBoundsException;

class TypeRegistry implements TypeRegistryInterface
{
    /**
     * @var TypeInterface[]
     */
    private $types = [];

    /**
     * @inheritdoc
     */
    public function register(TypeInterface $type)
    {
        $name = get_class($type);

        $this->types[$name] = $type;
    }

    /**
     * @inheritdoc
     */
    public function get(string $typeClass): TypeInterface
    {
        if (!isset($this->types[$typeClass])) {
            throw new OutOfBoundsException(sprintf(
                'There is no type registered with that class: "%s" (available classes are: "%s")',
                $typeClass,
                implode('","', array_keys($this->types))
            ));
        }

        return $this->types[$typeClass];
    }
}
