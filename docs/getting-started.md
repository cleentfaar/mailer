# Getting started

Let's say our company name is Acme and we want to send
a welcome email to any user signing up on our website.

### Creating a type

First, we create class implementing `TypeInterface`, or in our (simplified) case, extend `AbstractType`:

```php
<?php
    
namespace AppBundle\Mailer\Type;

use CL\Mailer\Message\Address;
use CL\Mailer\Message\Part\HtmlPart;
use CL\Mailer\Message\Part\PlainTextPart;
use CL\Mailer\MessageBuilderInterface;
use CL\Mailer\TypeInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class DemoType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function buildMessage(
        MessageBuilderInterface $builder, 
        TranslatorInterface $translator, 
        EngineInterface $templating, 
        array $options
    ) {
        $builder->setSender(new Address('support@acme.com', 'Acme Support'));
        $builder->addTo(new Address('john@doe.com', 'John Doe'));
        $builder->setSubject($translator->trans('demo.subject', [], 'mail'));

        $context = [];

        $builder->addPart(new HtmlPart($templating->render('mails/demo.html.twig', $context)));
        $builder->addPart(new PlainTextPart($templating->render('mails/demo.txt.twig', $context)));
    }
}

```

### Send an email using your type

Having created our type, we want to send it using a driver of our choice.
In theory, you could do all that yourself, by simply creating a class 
that implements `MailerInterface`.

But, with some additional bootstrapping,  you can make sending many 
different types of emails easy. 

Here's how:

```php
<?php

namespace Acme\Web;

use Acme\Mailer\Driver\MyDriver;
use Acme\Mailer\Type\DemoType;
use CL\Mailer\Mailer;
use CL\Mailer\MessageResolver;
use CL\Mailer\TypeRegistry;

// bootstrapping, you only need to do this once in your application
$driver = new MyDriver();
$type = new DemoType();

$registry = new TypeRegistry();
$registry->register($type);

$resolver = new MessageResolver($registry);

// sending the actual message
$mailer = new Mailer($resolver, $driver);
$mailer->send(DemoType::class);
```

### Configuring options

This is all nice and well but, if you look at the type class we 
created earlier, we hardcoded the destination address:

```php
// ...

$builder->addTo(new Address('john@doe.com', 'John Doe'));

// ...
```

If you think about it, this is pretty useless for a welcome mail,
we don't want to send the message to the same address everytime!

Instead we want the destination address to be dynamic. This is where options come into play.

Let's implement another method in our type class, namely `configureOptions`:

```php
<?php
    
namespace AppBundle\Mailer\Type;

use CL\Mailer\Message\Address;
use CL\Mailer\Message\Part\HtmlPart;
use CL\Mailer\Message\Part\PlainTextPart;
use CL\Mailer\MessageBuilderInterface;
use CL\Mailer\TypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class DemoType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function buildMessage(
        MessageBuilderInterface $builder, 
        TranslatorInterface $translator, 
        EngineInterface $templating, 
        array $options
    ) {
        // ...
        $builder->addTo($options['to']);
        // ...
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setRequired([
            'to',
        ]);

        $optionsResolver->setAllowedTypes('to', Address::class);
    }
}
```

#### The OptionsResolver
If the above seems alien to you, you might want to get yourself familiar with the [OptionsResolver](https://github.com/symfony/options-resolver) package first.
To summarize, the changes made above make sure that whenever your `Mailer` class sends a message, it must have this `to` option passed along with it.

### Done!
That's it, all that's left is to update your code to use the new `to` option:
```php
// before..
$mailer->send(
    DemoType::class
);

// after...
$mailer->send(
    DemoType::class, 
    [
        'to' => new Address($user->getEmail(), $user->getName())
    ]
);
```