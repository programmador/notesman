### Database

#### Create migration

./vendor/bin/phinx create CreateUsersTable -c database/config-phinx.php


#### Run migrations

./vendor/bin/phinx migrate -c database/config-phinx.php

#### Rollback migrations

./vendor/bin/phinx rollback -c database/config-phinx.php


### Todos

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

#### Validation

No validation is being performed in the project at all. The best decision would be using some kind
of easily set up library for that, for example as the one in Laravel. The other possible way is to
use a form handling library which is able to render, fill, validate, save and highlight errors.

#### Routing

1. FastRoute doesn't include any way to conveniently render route URI's by route names. Though maybe
   it includes one but it's not used in the project anyway.
2. Routes should be daclared in a separate config file. There's a lib for FastRoute at Github for
   implementing that. Though it has scarce documentation

#### Templates

JS and CSS assets should be apart from twig templates code

Check for selected file type in JS before allowing task preview

#### Usability

Make image non-obligatory