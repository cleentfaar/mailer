<?php

namespace CL\Mailer\Type;

class TypeRegistry
{
    /**
     * @var TypeInterface[]
     */
    private $types = [];

    /**
     * @param TypeInterface $type
     */
    public function register(TypeInterface $type)
    {
        $this->types[get_class($type)] = $type;
    }

    /**
     * @param string $type
     *
     * @return TypeInterface
     */
    public function get(string $type) : TypeInterface
    {
        if (!isset($this->types[$type])) {
            throw new \OutOfBoundsException(sprintf(
                'There is no mailer type registered under that name: "%s" (available types are: "%s")',
                $type,
                implode('","', array_keys($this->types))
            ));
        }

        return $this->types[$type];
    }
}
