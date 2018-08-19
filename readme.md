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