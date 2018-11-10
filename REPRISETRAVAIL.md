# Reprise d'un travail déposé sur Git sur une nouvelle machine

1. chargez votre clé ssh depuis votre clé usb

```sh
$ sudo cat /media/tpuser/nom_de_votre_cle/.ssh/id_rsa | ssh-add -

```
2. Faites un git clone de votre projet hébergé sur framagit
3. Construisez votre docker

``` sh
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec php bash
# dans le conteneur php
$ cd symfony
$ composer install
```
Votre application doit fonctionner
4. Continuez votre travail avec phpstorm.
