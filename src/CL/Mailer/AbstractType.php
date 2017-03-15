<?php

namespace CL\Mailer;

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
