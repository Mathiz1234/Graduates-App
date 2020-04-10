# About Graduates App
:man_student:
This is the database web application for displaying a list of school graduates based on PHP Laravel framework. It's provide many features to easily manage all graduates.
:woman_student:
## Features

To see all features of applications open changelog file - [CLICK HERE](https://github.com/Mathiz1234/Graduates-App/blob/master/CHANGELOG.md) :computer_mouse: .

## Getting Started

To install the project, firstly check if you meet the requirements.

### Requirements

  - PHP version 7.4.*
  - SMTP mail server
  - mysql database
  - all requirements  for [Laravel 5.8](https://laravel.com/docs/5.8/installation#server-requirements)
  - composer
  - npm

### Instaling

1. Download the the latest release and then enter in the terminal:

```
$ composer install
$ npm install
```

2. Then rename .env.example file to .env and then open it to declare:
- APP_URL
- AUTH_KEY (security key while creating a new user)
- DB_HOST
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD
- MAIL_HOST
- MAIL_PORT
- MAIL_USERNAME
- MAIL_PASSWORD
- MAIL_ENCRYPTION
- MAIL_FROM_NAME
- MAIL_FROM_ADDRESS

3. Then you need to create tables in the database using the command:

```
$ php artisan migrate
```

4. If you want, you can seed your database by custom data.

```
$ php artisan db:seed
```

5. You already have the application ready if you want to increase its performance enter in the terminal:

```
$ composer install --optimize-autoloader --no-dev
$ php artisan config:cache
$ php artisan route:cache
```

6. Remember, if you make any changes to .css or .js in /resources enter in the terminal:

```
$ npm run prod
```

## Application serving

You may use the `serve` Artisan command to quick deploy project locally. This command will start a development server at http://localhost:8000.

```
$ php artisan serve
```
## Tech
Graduates App uses a number of open source projects to work properly:

- Laravel
- Laravel-mix
- PHP Insights
- SCSS
- Bootstrap
- Fontawesome
- jQuery
- GIT

## Author

 **Mateusz Sutor** - mateusz.sutor.contact@gmail.com

## License
Copyright (c) 2020 Mateusz Sutor
All rights reserved.

Proprietary.
Any redistribution or reproduction of part or all of the contents (web application) in any form is prohibited other than you may use for your personal and non-commercial use only. You may not, except with our express written permission, distribute or commercially exploit the content (web application). Nor may you transmit it or store it in any other remote storage or any different form of electronic system.

For non-personal use, contact via mateusz.sutor.contact@gmail.com