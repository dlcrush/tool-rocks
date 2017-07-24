<?php

use Illuminate\Database\Seeder;
use App\Band;

class BandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Band::truncate();
      Band::create([
          'name' => 'Tool',
          'slug' => 'tool'
      ]);
    }
}
