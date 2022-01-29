# Lumen PHP Yellow Media test

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

#Install
- #Run on the docker
- [x] git clone git@github.com:seriklav/api_lumen.git
- [x] cd api_lumen
- [x] *docker-compose up* - after you can use **sail** for example *"sail up -d"* or "sail composer require"


#Tasks
- [x] Swagger documentation: http://localhost/api/documentation
- [x] Login user
- [x] Register user
- [x] RecoveryPassword user
- [x] Pivot table for company and user
- [x] Method for create new company for user
- [x] List of companies for user
- [x] Unit Tests
- [x] Postman Collections


#Endpoints
- [x] *Register request* **[POST]** - http://localhost/api/v1/user/register
- [x] *Login in app* **[POST]** - http://localhost/api/v1/user/sign-in
- [x] *Recover password* **[PATCH]** - http://localhost/api/v1/user/recover-password
- [x] *Show all companies of users* **[GET]** - http://localhost/api/v1/user/companies
- [x] *Created Company* **[POST]** - http://localhost/api/v1/user/companies


#Postman collections
- [x] https://www.postman.com/collections/5a5d12e9e356ecb6367a