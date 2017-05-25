# address-jockey

## Setup Database With Phinx

Log into PHP Container: `docker exec -it addressjockey_fpm_1 /bin/bash`

Migrate Schema: `vendor/bin/phinx migrate -e development`

Seed Data: `vendor/bin/phinx seed:run -s PeopleSeeder -s AddressesSeeder`
