# backend

## Comment installer 
Installer Composer : https://getcomposer.org/download/  
Installer Symfony : https://symfony.com/download  

Cloner la repository et installer les dépendances :  
```bash
git clone https://github.com/ProjectGiftApp/backend
cd backend
composer install
composer update
```

Puis mettre a jour les informations de connexion à la base de données :  
* Commencer par remplacer dans le fichier .env vos informations à propos de la connexion vers la base de données que vous utilisé (mysql avec XAMPP par exemple) : 
(Suivre l'exemple en dessous)
```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```
* Enfin on a besoin de créer la base de données et migrer les changements :
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Comment lancer le serveur
```bash
symfony serve
```

## Implémenter dans la base de données les fixtures (faux jeu de données)
```bash
php bin/console doctrine:fixtures:load
```
