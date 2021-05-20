# backend

## How to install

Install Composer : https://getcomposer.org/download/  
Install Symfony : https://symfony.com/download  

Clone the repository and install the dependencies :  
```bash
git clone https://github.com/ProjectGiftApp/backend
cd backend
composer install
composer update
```

Then create / update your database :  
Start by remplacing in file .env your information about the connection to the database you are using : 
(follow the template bellow)
```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```
Than you need to create the database and migrate the changes :
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## How to start
```bash
symfony serve
```

## Load fixtures (fake data)
```bash
php bin/console doctrine:fixtures:load
```
