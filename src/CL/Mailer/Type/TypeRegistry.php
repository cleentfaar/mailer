<?php

declare(strict_types=1);

namespace CL\Mailer\Type;

use Closure;
use OutOfBoundsException;

class TypeRegistry
{
    /**
     * @var TypeInterface[]
     */
    private $types = [];

    /**
     * @var Closure|null
     */
    private $namingStrategy;

    /**
     * @param Closure|null $namingStrategy
     */
    public function __construct(Closure $namingStrategy = null)
    {
        $this->namingStrategy = $namingStrategy ?: function (TypeInterface $type) { return get_class($type); };
    }

    /**
     * @param TypeInterface $type
     */
    public function register(TypeInterface $type)
    {
        $name = call_user_func_array($this->namingStrategy, [$type]);

        $this->types[$name] = $type;
    }

    /**
     * @param string $type
     *
     * @return TypeInterface
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
