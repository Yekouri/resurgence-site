# Wow Classic Resurgence-Skullflame guild website 

# Uses
* [PHP 7.3](https://www.php.net/downloads.php)
* [Mysql 5.7](https://dev.mysql.com/doc/refman/5.7/en/)
* [Symfony 4.3](https://symfony.com/doc/current/index.html#gsc.tab=0)
* [Twig](https://symfony.com/doc/current/templates.html#twig-templating-language)
* [Doctrine ORM](https://symfony.com/doc/current/doctrine.html)
* [Zepto JQuery](https://zeptojs.com/)

# Setup
## Requirements
* [Docker](https://docs.docker.com/install/)
* [Docker-compose](https://docs.docker.com/compose/)
* [Node Package Manager](https://www.npmjs.com/get-npm)
* [Gulp](https://gulpjs.com/)

## Intial
Create docker container and let it build images.
```
docker-compose up -d
```
Install dependencies
```
docker-compose exec php composer install
```

## Usage
Start docker container
```
docker-compose up -d
```
Access composer
```
docker-compose exec php composer
```
Access mysql server
```
docker-compose exec db bash
```
Login using CLI
```
$ mysql -u [USER] -p [PASSWORD]
```

Build css and javascript
```
gulp build
```

# Doctrine 
**Standing inside the docker container first**
```
docker-compose exec php bash
```

Create a new entity 
```
$ bin/console make:entity [Entity]
```

Create a new migration version
```
$ php bin/console make:migration
```

Apply migration to database
```
$ bin/console doctrine:migrations:migrate
```
