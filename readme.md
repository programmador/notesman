### Database

#### Create migration

./vendor/bin/phinx create CreateUsersTable -c database/config-phinx.php


#### Run migrations

./vendor/bin/phinx migrate -c database/config-phinx.php

#### Rollback migrations

./vendor/bin/phinx rollback -c database/config-phinx.php