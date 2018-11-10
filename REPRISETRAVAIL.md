# Reprise d'un travail déposé sur Git sur une nouvelle machine

1. chargez votre clé ssh depuis votre clé usb

```sh
$ sudo cat /media/tpuser/nom_de_votre_cle/.ssh/id_rsa | ssh-add -

```
**OU**

générez une nouvelle clé en l'ajoutant aux paramètres de votre compte framagit.

2. Faites un git clone de votre projet hébergé sur framagit

**OU**

Dans phpstorm, vous pouvez choisir VCS->Checkout From Version Control->Git en collant votre dépôt git.

3. Construisez votre docker

``` sh
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec php bash
# dans le conteneur php
$ cd symfony
$ composer install
```
Votre application doit fonctionner.

4. Continuez votre travail avec phpstorm.
