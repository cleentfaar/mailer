<?php

declare(strict_types=1);

namespace CL\Mailer;

interface TypeRegistryInterface
{
    /**
     * @param TypeInterface $type
     */
    public function register(TypeInterface $type);

    /**
     * @param string $typeClass
     *
     * @return TypeInterface
     */
    public function get(string $typeClass): TypeInterface;
}
