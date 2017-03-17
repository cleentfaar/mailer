<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

class Address implements AddressInterface
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
     * @inheritdoc
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
