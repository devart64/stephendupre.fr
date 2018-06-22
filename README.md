# Docker Symfony (PHP7-FPM - NGINX - MySQL - ELK)

Docker-symfony4 vous donne tout ce que vous avez besoin pour développer des applications sous Symfony 4.
C'est une architecture complète à utiliser avec docker et [docker-compose (1.7 or higher)](https://docs.docker.com/compose/).

## Prérequis

1. Avoir docker !


## Installation

1. Dupliquer le projet :
    ```bash
    git clone git@framagit.org:nicolasunivlr/docker-symfony4.git
    ```


2. Construire et exécuter les containeurs (Cela peut prendre un peu de temps la première fois)

    ```bash
    $ docker-compose build
    $ docker-compose up -d
    ```

3. Mettre à jour votre fichier hosts

    ```bash
    # UNIX only: get containers IP address and update host (replace IP according to your configuration) (on Windows, edit C:\Windows\System32\drivers\etc\hosts)
    $ sudo echo $(docker network inspect bridge | grep Gateway | grep -o -E '[0-9\.]+') "symfony.local" >> /etc/hosts
    ```

    **Note:** For **OS X**, please take a look [here](https://docs.docker.com/docker-for-mac/networking/) and for **Windows** read [this](https://docs.docker.com/docker-for-windows/#/step-4-explore-the-application-and-run-examples) (4th step).

4. Installer Symfony
    1. On installe les composants avec Composer

        ```bash
        $ docker-compose exec php bash
        $ composer require ....
        ```
    2. Mettre à jour symfony/.env

        ```yml
        # path/to/your/symfony-project/app/config/parameters.yml
        parameters:
            database_host: db
        ```

5. C'est parti :-)

## Utilisation

Vous avez juste à exécuter `docker-compose up -d`, puis:

* Application symfony [symfony.local](http://symfony.local)  
* Logs (Kibana): [symfony.local:81](http://symfony.local:81)
* Logs (files location): logs/nginx and logs/symfony

## Comment cela fonctionne ?

Vous pouvez aller regarder le fichier `docker-compose.yml`, avec les images `docker-compose` correspondantes:

* `db`: le container mysql 5.7,
* `php`: php-fpm en version 7.2,
* `nginx`: le serveur web nginx,
* `elk`: la visualisation des logs avec Elasticsearch et Kibana.

## Commandes utiles


```bash
# On rentre dans un conteneur en bash
$ docker-compose exec php bash

# Mise à jour de Composer
$ docker-compose exec php composer update

# Commandes symfony
$ docker-compose exec php bash
$ sf doctrine:schema:update ...

# Supprimer tous les conteneurs 
$ docker rm $(docker ps -aq)

# Supprimer toutes les images
$ docker rmi $(docker images -q)
```

## FAQ

* Xdebug?
Xdebug est déjà configuré
Il faut configurer l'IDE en se connectant au port  `9001` avec l'id `PHPSTORM`