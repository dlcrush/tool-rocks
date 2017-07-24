<?php

use Illuminate\Database\Seeder;
use App\Album;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Album::truncate();
      
      // Tool albums
      
      Album::create([
        'name' => '72826',
        'slug' => '72826',
        'band_id' => 1,
        'release_date' => "1991-12-21"
      ]);
      
      Album::create([
        'name' => 'Opiate',
        'slug' => 'opiate',
        'band_id' => 1,
        'release_date' => "1992-03-10"
      ]);
      
      Album::create([
        'name' => 'Undertow',
        'slug' => 'undertow',
        'band_id' => 1,
        'release_date' => "1993-04-06"
      ]);
      
      Album::create([
        'name' => 'Aenima',
        'slug' => 'aenima',
        'band_id' => 1,
        'release_date' => "1996-09-17"
      ]);
      
      Album::create([
        'name' => 'Salival',
        'slug' => 'salival',
        'band_id' => 1,
        'release_date' => "2000-12-12"
      ]);
      
      Album::create([
        'name' => 'Lateralus',
        'slug' => 'lateralus',
        'band_id' => 1,
        'release_date' => "2001-05-15"
      ]);
      
      Album::create([
        'name' => '10,000 Days',
        'slug' => '10000-days',
        'band_id' => 1,
        'release_date' => "2006-05-02"
      ]);
    }
}
