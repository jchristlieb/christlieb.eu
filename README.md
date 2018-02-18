# christlieb.eu
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/120960044/shield?branch=master)](https://styleci.io/repos/120960044)
[![Build Status](https://travis-ci.org/bambamboole/christlieb.eu.svg?branch=master)](https://travis-ci.org/bambamboole/christlieb.eu)  
This repository contains the source of my personal blog which you can find [here](https://christlieb.eu).  

You are free to use the source code in any project you need or fork the whole blog.

### Installation
Installation is like normal laravel applications

1. `composer install`
2. `cp.env.example .env`
3. `php artisan key:generate`
4. `php artisan migrate`
5. `npm install`
6. `npm run dev`  

Don't miss to fill in database credentials

There is a database seeder for initial dummy data:  
`php artisan db:seed`

### Tests
There are [phpunit](https://github.com/sebastianbergmann/phpunit) tests as well as vue tests. The vue tests are based on [facebook/jest](https://github.com/facebook/jest).  
They can be run by simply executing `./vendor/bin/phpunit` or `npm run test` for the vue tests.

### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


### Security
If you discover any security related issues, please email manuel@christlieb.eu instead of using the issue tracker.

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
