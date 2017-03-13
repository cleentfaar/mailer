<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

class Address
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param string      $email
     * @param string|null $name
     */
    public function __construct(string $email, string $name = null)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
