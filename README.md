#Backend

## Comment installer 
Utiliser php 8 ou supérieur  
Installer Composer : https://getcomposer.org/download/  
Installer Symfony : https://symfony.com/download  

Cloner la repository et installer les dépendances :  
```shell
git clone https://github.com/ProjectGiftApp/backend
cd backend
composer install
composer update
```

Puis mettre a jour votre base de données :  
* Commencer par remplacer dans le fichier .env vos informations à propos de la connexion vers la base de données que vous utilisé (mysql avec XAMPP par exemple) : 
(Suivre l'exemple en dessous)
```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```
* Enfin on a besoin de créer la base de données et migrer les changements :
```shell
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Generer la clef publique et privée
```shell
php bin/console lexik:jwt:generate-key
```

## Lancer le serveur en local
```shell
symfony serve
```

## Liste les truc fait
Intaller api platform  
Créer entité User  
Chiffrer les mot de passes  
JWT Token generer  
JWT Token Authentication pour recup les données  

## TODO
finir la base de données (repport du MCD)  
Email verification  

# WIP (Ne pas le faire) ------------------------------------

Rappel generer les clé public & privé
```shell
& 'C:\Program Files\Git\usr\bin\openssl.exe' genrsa -out config/jwt/private.pem -aes256 4096
& 'C:\Program Files\Git\usr\bin\openssl.exe' rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

Ajouter
.env.local : 
```txt
###> lexik/jwt-authentication-bundle ###
JWT_PASSPHRASE=39deb2c94453cec93d6608e617c62fa0
###< lexik/jwt-authentication-bundle ###
``` 