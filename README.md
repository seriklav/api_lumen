# Lumen PHP Yellow Media test

#Tasks
- [x] Работа через docker и laravel командой sail
- [x] Swagger documentation: http://localhost/api/documentation
- [x] Versions of api
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

#Run on the docker
 - *docker-compose up* - after you can use **sail** for example *"sail up -d"* or "sail composer require"