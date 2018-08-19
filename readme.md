### Database

#### Create migration

./vendor/bin/phinx create CreateUsersTable -c database/config-phinx.php


#### Run migrations

./vendor/bin/phinx migrate -c database/config-phinx.php

#### Rollback migrations

./vendor/bin/phinx rollback -c database/config-phinx.php


### Todos

#### User Controller

This controller is needed only as a proof of concept to demonstrate that the project can
deal with a database storage and render data using a template engine. Neither the controller
nor templates that it's using are needed. Moreover keeping this controller in the project is
insecure as the controller is too simple and does not include any authentication.

#### Test

Is there really anything decent to test in this project?

#### Template engine cache

It's disabled for development convenience (commented out in AbstractController).
For production:
1. Service container should be implemented in a project. Twig should be a container instead of a
   static var in Abstract Controller.
2. Twig should have it's own config file including cache configuration.

#### Database schema

Add index at least to email column of users table. Should be done in a new migration