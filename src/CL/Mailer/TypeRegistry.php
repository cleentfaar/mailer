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
    public function get(string $type): TypeInterface
    {
        if (!isset($this->types[$type])) {
            throw new OutOfBoundsException(sprintf(
                'There is no mailer type registered under that name: "%s" (available types are: "%s")',
                $type,
                implode('","', array_keys($this->types))
            ));
        }

        return $this->types[$type];
    }
}
