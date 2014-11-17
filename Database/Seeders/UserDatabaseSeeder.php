<?php namespace User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call("User\\Database\\Seeders\\" . Config::get('User::userdriver.driver') . "\\SentryGroupSeedTableSeeder");
    }

}
