# Installation

### Dépendances :

`composer install`

### Base de donnée :

Configuration du fichier .env.local :

> DATABASE_URL="mysql://root@127.0.0.1:3306/e-shop?serverVersion=5.7"

Puis dans la console :

`php bin/console d:d:c && php bin/console d:s:u -f`

### Lancer le Serveur :

`symfony serve`
