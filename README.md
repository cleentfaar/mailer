# Mailer, a driver-agnostic email library for PHP

[![Build Status](https://travis-ci.org/cleentfaar/mailer.svg?branch=master)](https://travis-ci.org/cleentfaar/mailer)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/cleentfaar/mailer.svg)]()
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/cleentfaar/mailer.svg)]()
[![Github All Releases](https://img.shields.io/github/downloads/cleentfaar/mailer/total.svg)]()


### Installation

The recommended way to install Mailer is through [Composer](http://getcomposer.org).

```bash
php composer.phar require cleentfaar/mailer
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```


### Documentation

1. [Getting started](docs/getting-started.md)
1. [Events](docs/templating.md)
1. [Contributing](docs/contributing.md)


### Packages depending on this library

The following packages depend on this library:

| Package | Description |
| :------ | :---------- |
| [mailer-swiftmailer](https://github.com/cleentfaar/mailer-swiftmailer) (driver) | Driver that implements the Swiftmailer engine (recommended) |
| [mailer-bundle](https://github.com/cleentfaar/mailer-bundle) | Symfony bundle that let's you use the Mailer library in your Symfony projects |


### Suggested packages

[leemunroe](https://github.com/leemunroe)'s [HTML email template](https://github.com/leemunroe/responsive-html-email-template) can be used as a base for your HTML templates.
