# ToDoList

## About

An application to manage daily tasks.
Project 8 of the OpenClassrooms "Application Developer - PHP / Symfony" course.

## Requirements

+ PHP: ToDoList requires PHP version 7.1 or greater. 
+ MySQL: for the database
+ Composer: to install the dependencies.

## Installation

Clone project : https://github.com/imaneis/projet08oc.git

Give write access to the /var directory

```bash
chmod 777 -R var
```

Then

```bash
composer install
```

Configure the application by completing the file /app/config/parameters.yml

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:create 
```

If you want to use a data set

```bash
php bin/console doctrine:fixtures:load
```

## Tests

You can start the tests with the following command:

```bash
./vendor/bin/simple-phpunit --coverage-html web/test-coverage
```


## Author

Imane Issany 
