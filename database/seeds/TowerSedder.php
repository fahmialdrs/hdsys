<?php

use Illuminate\Database\Seeder;

class TowerSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tower::class, 10)->create();
    }
}
