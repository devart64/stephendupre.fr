# Docker Symfony (PHP7-FPM - NGINX - MariaDB)

Cet environnement correspond à l'environnement de production du serveur lpmiaw.univ-lr.fr à savoir :

    - php 7.2
    - mariadb 10.1

Docker-symfony4 vous donne tout ce que vous avez besoin pour développer des applications sous Symfony 4.
C'est une architecture complète à utiliser avec docker et [docker-compose (version 1.7 minimum)](https://docs.docker.com/compose/).

## Prérequis

1. Avoir [docker](https://docs.docker.com/install/) et [docker-compose](https://docs.docker.com/compose/install/#install-compose)
2. Avoir Phpstorm. Votre statut d'étudiant vous donne droit à une licence gratuite de la suite.

## Installation

1. Dupliquer le projet :
    ```bash
    git clone https://framagit.org/nicolasunivlr/docker-symfony4.git
    ```

2. (facultatif) Modifier le ficher .env si besoin pour activer et/ou modifier le proxy


3. Construire et exécuter les conteneurs (Cela peut prendre un peu de temps la première fois)

    ```bash
    $ docker-compose build
    $ docker-compose up -d
    ```

4. Mettre à jour votre fichier hosts sur votre machine perso (pas nécessaire sur les ordinateurs de l'Université)

    ```bash
    # Linux: on associe l'adresses local au nom de l'application
    $ sudo echo "127.0.0.1 symfony.localhost" >> /etc/hosts
    # Windows : mettre à jour le fichier C:\Windows\System32\drivers\etc\hosts avec le même contenu que ci-dessus
    ```

    **Note:** Pour **OS X**, Allez voir [ici](https://docs.docker.com/docker-for-mac/networking/) et pour **Windows** lisez [ici](https://docs.docker.com/docker-for-windows/#/step-4-explore-the-application-and-run-examples) (4ème étape).

5. Installer Symfony
    1. On installe symfony en version minimale avec Composer. On installe les composants nécessaires à nos applications également avec Composer

        ```bash
        $ docker-compose exec php bash
        $ composer create-project symfony/skeleton symfony
        $ cd symfony
        $ composer require --dev profiler
        $ composer require annotations
        $ composer require twig
        $ composer require orm
        $ composer require form
        $ composer require validator
        $ composer require --dev maker-bundle
        $ composer require symfony/apache-pack
        ```
    
    2. Mettre à jour les droits pour modifier ses fichiers depuis PhpStorm
        - Récupérer l'identifiant de son utilisateur
        
            ```bash
            $ id -u
            ```
        - Ajouter dans le conteneur php, un utilisateur avec le même id que le sien
        
            ```bash
            $ adduser --uid numero_recupéré_ci_dessus login_correspondant_id
            ```
        - Mettre à jour les droits sur les fichiers
        
            ```bash
            $ chown -R login_correspondant_id:login_correspondant_id symfony
            ```

    3. Mettre à jour symfony/.env en modifiant DATABASE_URL comme ceci :

        ```yml
        DATABASE_URL=mysql://symfony:symfony@db:3306/symfony
        ```

6. C'est parti :-)

## Je commence à travailler sur le projet

Vous avez juste à exécuter `docker-compose up -d`, puis:

* Application symfony [symfony.localhost:8000](http://symfony.localhost:8000)
* Logs du serveur web : logs/nginx

## Je finis de travailler sur le projet
Vous avez juste à exécuter `docker-compose down`.

## Comment cela fonctionne ?

Vous pouvez aller regarder le fichier `docker-compose.yml`, avec les images `docker-compose` correspondantes:

* `db`: le container mariadb 10.1,
* `php`: php-fpm en version 7.2,
* `nginx`: le serveur web nginx,

## Commandes utiles


```bash
# On rentre dans un conteneur en bash
$ docker-compose exec php bash

# Mise à jour de Composer
$ docker-compose exec php composer update

# Commandes symfony
$ docker-compose exec php bash
$ sf make:entity
$ sf make:controller
...

# Supprimer tous les conteneurs (en cas de gros plantage, à utiliser en dernier recours)
$ docker rm $(docker ps -aq)

# Supprimer toutes les images (en cas de gros plantage, à utiliser en dernier recours)
$ docker rmi $(docker images -q)
```

## FAQ
* Je ne comprends rien, que faire ?
Allez voir votre prof !

* Xdebug?
Xdebug est déjà configuré
Il faut ajouter le module Xdebug helper pour Firefox ou pour Chrome
Il faut également configurer Phpstorm en se connectant au port  `9001` avec l'id `PHPSTORM`. Vous pouvez suivre ce [lien](https://blog.eleven-labs.com/fr/debug-run-phpunit-tests-using-docker-remote-interpreters-with-phpstorm/). Le dépôt que vous utilisez est déjà paramétré. Utilisez docker-compose à la place de docker dans le "Remote" de l'interpréteur PHP.
