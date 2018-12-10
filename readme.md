# Web-App - DHBW

Little Web-App developed during the PHP-Course at University.

## Getting Started

Follow the instructions below

### Prerequisites

We assume you have pre-installed:

* Node - https://nodejs.org/en/
* Composer - https://getcomposer.org/doc/00-intro.md
* Vagrant - https://www.vagrantup.com/
* Virtualbox - https://www.virtualbox.org/


### Installing

First you have to clone the Repo:

```
git clone https://github.com/bennias/webapp.git
```

Navigate into the project-directory and install project dependencies with composer and npm:

```
npm install
composer install
```

Now you have to change the current directory in the Homestead.yaml-file:

```
folders:
    map: path/to/my/projectdirectory
```

## Starting

1. Open the Terminal
2. Navigate into the Directory
3. Run Vagrant
4. Migrate Database Tables

```
cd path/to/my/project
vagrant up --provision
```

after Vagrant has started:

```
vagrant ssh
cd /code
php artisan migrate
```

Open the Webapp:
http://192.168.10.10



## Built With

* [Laravel Homestead](https://laravel.com/docs/5.5/homestead) - The web framework used
* [NPM](https://www.npmjs.com/) - Node Dependency Management 
* [Composer](https://getcomposer.org/) - PHP Dependency Management 
* [Bootstrap 4](https://getbootstrap.com/) - CSS Framework used


## Versioning

We use [Git](https://git-scm.com/) for versioning.

## Authors

[Benni Asal](https://github.com/BenniAsal)  - *Initial work*


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

