TestTwitterAPI
========================

Technologies: Symfony2 (framework-standard-edition), Doctrine, MySQL


Usage:
========================

- Download zip / git clone
- cd TestTwitterAPI-master
- composer install (Install dependencies)
- php app/console doctrine:database:create (Create database)
- php app/console doctrine:schema:update --force (Execute queries to update database)
- create new app on apps.twitter.com
- provide app keys and access tokens (src/Test/TwitterBundle/Resources/twitter.conf.yml)
- provide list_id and list_slug of the list you will use (src/Test/TwitterBundle/Controller/DefaultController)





[1]:  https://symfony.com/doc/2.8/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/2.8/book/doctrine.html
[8]:  https://symfony.com/doc/2.8/book/templating.html
[9]:  https://symfony.com/doc/2.8/book/security.html
[10]: https://symfony.com/doc/2.8/cookbook/email.html
[11]: https://symfony.com/doc/2.8/cookbook/logging/monolog.html
[13]: https://symfony.com/doc/2.8/bundles/SensioGeneratorBundle/index.html
