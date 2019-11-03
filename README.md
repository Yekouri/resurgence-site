# Wow Classic Resurgence-Skullflame guild website 

# Uses
* [PHP 7.3](https://www.php.net/downloads.php)
* [Mysql 5.7](https://dev.mysql.com/doc/refman/5.7/en/)
* [Symfony 4.3](https://symfony.com/doc/current/index.html#gsc.tab=0)
* [Twig](https://symfony.com/doc/current/templates.html#twig-templating-language)
* [Doctrine ORM](https://symfony.com/doc/current/doctrine.html)


# Setup
## Requirements
* [Docker](https://docs.docker.com/install/)
* [Docker-compose](https://docs.docker.com/compose/)

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
Access mysql
```
docker-compose exec db bash
```

# Doctrine 
Create a new entity 
```
docker-compose exec php bin/console make:entity <Entity>
```

Create a new migration version
```
docker-compose exec php bin/console make:migration
```

Apply migration to database
```
docker-compose exec php bin/console doctrine:migrations:migrate
```
