## Introduction

I used Lumen framework to develop these apis.

https://lumen.laravel.com/

## Some constraints

1. For the subject, the user can only edit code, name and description.
2. The user can see and edit hidden subject. I suppose the hidden field may be a field for front-end use.
3. Deleted subject are still in the database, using soft delete

## Deployment 

## Clone code and run composer

Enter the root folder and run:

```bash
composer install
```

### Set up database

1. Enter the root folder of the code, create a database.sqlite file in database folder.

   ```bash
   touch database/database.sqlite
   ```

2. Run php artisan to create tables

   ```bash
   php artisan migrate	
   ```

3. Create fake data

   ```bash
   php artisan db:seed --class=CoursesTableSeeder
   php artisan db:seed --class=SubjectsTableSeeder
   ```

### Start server

```bash
php -S localhost:8000 -t public
```

Then you can get access to the apis. Here are some examples using curl:

```bash
#Get All courses
curl "http://localhost:8000/courses"

#Get the subjects of one course
curl "http://localhost:8000/courses/1/subjects"

#Get the details of one course
curl "http://localhost:8000/subjects/3"

#Edit one subject
curl -v -X PUT  -H "Content-Type:application/json" -d '{"name": "jfkdjfkdjfkjd"}' "http://localhost:8000/subjects/1"

#Delete one subject
curl -v -X DELETE "http://localhost:8000/subjects/2"

#Hide one subject
curl -v -X PATCH  -H "Content-Type:application/json" -d '{"hidden":2}' "http://localhost:8000/subjects/1"

#Unhide one subject
curl -v -X PATCH  -H "Content-Type:application/json" -d '{"hidden":1}' "http://localhost:8000/subjects/1"
```

### Run test

Enter the root folder of the code and run:

```bash
./vendor/bin/phpunit
```



## For Api Authentication

One solution is to use the code field as authentication, using md5( name + secretKey) to generate the code. For each request, we can just verify the code.
