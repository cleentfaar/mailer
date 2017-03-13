<?php

namespace CL\Mailer\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractType implements TypeInterface
{
    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
    }
}
