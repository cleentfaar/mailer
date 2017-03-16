# Getting started

Let's say our company name is Acme and we want to send
a welcome email to any user signing up on our website.

### Creating a type

First, we create class implementing `TypeInterface`, or in our (simplified) case, extend `AbstractType`:

```php
<?php

namespace Acme\Mailer\Type;

use CL\Mailer\AbstractType;
use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use CL\Mailer\Message\Header\Address;
use CL\Mailer\Message\Body\Attachment\FileAttachment;
use CL\Mailer\Message\Body\Part\HtmlPart;
use CL\Mailer\Message\Body\Part\PlainTextPart;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class WelcomeUserType extends AbstractType
{
    /**
     * @inheritdoc 
     */
    public function buildHeader(HeaderInterface $header, TranslatorInterface $translator, array $options)
    {
        $header->addTo(new Address('john@doe.com', 'John Doe'));
        
        $header->setSender(new Address('support@acme.com', 'Acme Support'));
        
        // example of using translation for subjects
        $header->setSubject($translator->trans('welcome_user.subject', [], 'mail'));
    }

    /**
     * @inheritdoc 
     */        
    public function buildBody(BodyInterface $body, EngineInterface $templating, array $options)
    {
        $body->setMainPart(new HtmlPart($templating->render('acme/mails/welcome_user.html.twig')));
        
        // optionally, you may want to provide a
        // plain-text version of your email
        $body->setAlternativePart(new PlainTextPart($templating->render('acme/mails/welcome_user.txt.twig')));
        
        // optionally, you may want to add an attachment
        $attachment = new FileAttachment(new File('/path/to/attachment')); 
        $body->addAttachment($attachment);
    }
}

```

### Send an email using your type

Having created our welcome type, we want to send it using a driver of our choice.
In theory, you could do all that yourself, by simply creating a class 
that implements `MailerInterface`.

But, with some additional bootstrapping,  you can make sending many 
different types of emails easy. 

Here's how:

```php
<?php

namespace Acme\Web;

use Acme\Mailer\Driver\MyDriver;
use Acme\Mailer\Type\WelcomeUserType;
use CL\Mailer\Mailer;
use CL\Mailer\MessageResolver;
use CL\Mailer\TypeRegistry;

// bootstrapping, you only need to do this once in your script
$driver = new MyDriver();
$type = new WelcomeUserType();

$registry = new TypeRegistry();
$registry->register($type);

$resolver = new MessageResolver($registry);

// sending the actual message
$mailer = new Mailer($resolver, $driver);
$mailer->send(WelcomeUserType::class);
```

### Configuring options

This is all nice and well but, if you look at the type class we 
created earlier, we hardcoded the destination address:

```php
// ...

$header->addTo(new Address('john@doe.com', 'John Doe'));

// ...
```

If you think about it, this is pretty useless for a welcome mail,
we don't want to send the message to the same address everytime!

Instead we want the destination address to be dynamic. This is where options come into play.

Let's implement another method in our type class, namely `configureOptions`:

```php
<?php

namespace Acme\Mailer\Type;

use CL\Mailer\AbstractType;
use CL\Mailer\Message\HeaderInterface;
use CL\Mailer\Message\Header\Address;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

class WelcomeUserType extends AbstractType
{
    /**
     * @inheritdoc 
     */
    public function buildHeader(HeaderInterface $header, TranslatorInterface $translator, array $options)
    {
        $header->addTo($options['to']);
        
        // ...
    }
    
    /**
     * @inheritdoc 
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['to']);
        $resolver->setAllowedTypes('to', [Address::class]);
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
    WelcomeUserType::class
);

// after...
$mailer->send(
    WelcomeUserType::class, 
    [
        'to' => new Address($user->getEmail(), $user->getName())
    ]
);
```