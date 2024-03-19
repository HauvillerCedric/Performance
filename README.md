# Performance

## The Project


The Performance project is a website for the Performance driving school. It is a showcase website but also has several functionalities. As an auto school is a local business, the site is entirely in French, and there is no need for translation.

    * Ability to add employees.
    * Implementation of agency schedules.
    * Creation of the pricing grid for different licenses.
    * All these functionalities are achievable through an administration panel.

## Features
##### Firewall 
    * Some roles are already configured: ROLE_SUPER_ADMIN ; ROLE_ADMIN.
    * A custom user checker is configured in src/Security/UserChecker.php preventing User to log in if not active.

##### Secrets
Secret command is heavily used to store passwords, even for .env file. Here is a default list with variables (use "php bin/console secrets:list" to show in terminal) :
* DATABASE_URL : to connect to your database.
* MAILER_DSN : to connect to your mail box.
* MAILER_FROM_ADDRESS : the destination email address. 

##### Documents (doc)
A "documents" directory is already created in root project. You can store any document relative to the projects/technologies used. By default you can find :
* UML : store UML schemas (txt & jpeg). https://app.diagrams.net is used to generate theses files.

##### Creation of the super-admin
The loaded data already includes several users; nevertheless, you must create your own user who will have all the rights. A command has been specially created for this purpose:
```
php bin/console app:create-super-admin
```

##### Authentication
    * Login page : /login
    * Forgotten password page
    * Login throttling : manage it in /config/packages/security.yaml

##### Image
"The images for the site (including banners) are present in the repository (/public/assets/images). However, the images that are uploadable are not there (public/uploads/images). Feel free to proceed according to your imagination!"

## Installing
Create directories
```
mkdir -p uploads/images/{actualities,agencies,users}
```

Generate vendors
```
composer self-update
composer install
composer update
```

Generate node_module and use Webpack Encore
```
npm install
npm run watch
```

Generate env variables
```
# Local purpose
php bin/console secrets:set --local DATABASE_URL            # mysql://username:password@127.0.0.1:3306/my_project?serverVersion=5.7&charset=utf8mb4
php bin/console secrets:set --local MAILER_DSN              # smtp://no-reply@mymail.com:password@domainServer
php bin/console secrets:set --local MAILER_FROM_ADDRESS     # test@gmail.com
```

Create database
```
php bin/console doctrine:database:create
```

Create migrations
```
php bin/console doctrine:migrations:migrate
```

Data fixtures
```
php bin/console doctrine:fixtures:load --append
```

Create super-admin
```
php bin/console app:create-super-admin
```

## Built With
Symfony 7.0, PHP8.3 and these bundles :

* [EasyAdmin](https://github.com/EasyCorp/EasyAdminBundle) - Manage backoffice
* [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html) - Fixtures are used to load a "fake" set of data into a database
* [webpack-encore](https://github.com/symfony/webpack-encore) - Webpack Encore is a simpler way to integrate Webpack into your application. It wraps Webpack, giving you a clean & powerful API for bundling JavaScript modules, pre-processing CSS & JS and compiling and minifying assets. Encore gives you a professional asset system that's a delight to use.
* [doctrine-extensions/DoctrineExtensions](https://github.com/doctrine-extensions/DoctrineExtensions) - Add extensions/listener for doctrine entities
* [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle) - The VichUploaderBundle is a Symfony bundle that attempts to ease file uploads that are attached to ORM entities, MongoDB ODM documents, or PHPCR ODM documents.

## Authors & contributors
* **Cédric.Hauviller** - *Initial work*
* [Github](https://github.com/HauvillerCedric)
* [Linkedin](https://www.linkedin.com/in/c%C3%A9dric-hauviller-970518272)
* email : hauviller.cedric@gmail.com


## Acknowledgment:
To the Performance driving school for providing the logo and its graphic charter.