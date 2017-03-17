<?php

namespace CL\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
    }
}
