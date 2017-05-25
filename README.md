## address-jockey

<a href="https://koding.com/"> <img src="https://koding-cdn.s3.amazonaws.com/badges/made-with-koding/v1/koding_badge_ReadmeDark.png" srcset="https://koding-cdn.s3.amazonaws.com/badges/made-with-koding/v1/koding_badge_ReadmeDark.png 1x, https://koding-cdn.s3.amazonaws.com/badges/made-with-koding/v1/koding_badge_ReadmeDark@2x.png 2x" alt="Made with Koding" /> </a>

## Setup Database With Phinx

Log into PHP Container: `docker exec -it addressjockey_fpm_1 /bin/bash`

Migrate Schema: `vendor/bin/phinx migrate -e development`

Seed Data: `vendor/bin/phinx seed:run -s PeopleSeeder -s AddressesSeeder`
