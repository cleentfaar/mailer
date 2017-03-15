<?php

namespace CL\Mailer;

interface TypeRegistryInterface
{
    /**
     * @param TypeInterface $type
     */
    public function register(TypeInterface $type);

    /**
     * @param string $type
     *
     * @return TypeInterface
     */
    public function get(string $type): TypeInterface;
}