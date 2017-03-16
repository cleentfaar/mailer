# Introduction
 
Mailer is a library for creating and sending emails in PHP.
The library itself is driver-agnostic, meaning it does not know what
method you use to send emails, as long as it implements the correct interface.

The steps involved in creating and sending an email with Mailer can be described as follows:
1. You configure header and body information (such as a TO-address and the content) in a class implementing `TypeInterface`.
1. The type instance is stored in a registry to allow for more types to be added (if using the default `MessageResolver` class).
1. You pass the resolver to your mailer (if using the default `Mailer` class).
1. Whenever you want to send a message you pass the type's class (and options, if needed) to the `Mailer::send()` method.
1. The `Mailer` uses it's resolver to resolve the message.
1. The `Mailer` uses it's configured driver to send the resolved message.
