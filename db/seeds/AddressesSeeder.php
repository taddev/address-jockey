<?php
// @codingStandardsIgnoreFile

use Phinx\Seed\AbstractSeed;

class AddressesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i=0; $i<10; $i++) {
            $data[] = [
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip' => $faker->postcode,
                'people_id' => rand(1,10)
            ];
        }

        $this->insert('addresses', $data);
    }
}
