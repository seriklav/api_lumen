# Lumen PHP Yellow Media test

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

#Install
- [x] git clone git@github.com:seriklav/api_lumen.git
- [x] cd api_lumen
- [x] docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php81-composer:latest \
  composer install --ignore-platform-reqs
- [x] **sail cp .env.example .env**


#Tasks
- [x] Swagger documentation: http://localhost/api/documentation
- [x] Pivot table for company and user
- [x] Unit Tests
- [x] Postman Collections


#Endpoints
- [x] *Register user* **[POST]** - http://localhost/api/v1/user/register
- [x] *Login user* **[POST]** - http://localhost/api/v1/user/sign-in
- [x] *RecoveryPassword user* **[PATCH]** - http://localhost/api/v1/user/recover-password
- [x] *List of companies for user* **[GET]** - http://localhost/api/v1/user/companies
- [x] *Method for create new company for user* **[POST]** - http://localhost/api/v1/user/companies


#Postman collections
- [x] https://www.postman.com/collections/5a5d12e9e356ecb6367a