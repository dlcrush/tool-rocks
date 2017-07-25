<?php

use Illuminate\Database\Seeder;
use App\Song;
use App\Band;
use App\Album;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Song::truncate();
        DB::table('songs_albums')->truncate();

        $songs = [
          [
            "name" => "Sweat",
            "slug" => "sweat",
            'albums' => ['opiate' => 1],
            'lyrics' => "I'm sweating, and breathing and staring and thinking and sinking deeper.\n\nIt's almost like I'm swimming.\nThe sun is burning hot again on the hunter and the fisherman, and he's trying to remember when, but it makes him dizzy.\n\nSeems like I've been here before. \nSeems so familiar. \nSeems like I'm slipping into a dream within a dream. \n\nMust be the way you whisper. \nThe sun is setting cool again. \nI'm the thinker and the fisherman and I'm trying to remember when but it makes me dizzy.\n\nAnd I'm sweating, and breathing, and staring and thinking and sinking deeper and it's almost like I'm swimming.\n\nSeems like I've been here before. \nSeems so familiar. \nSeems like I'm slipping into a dream within a dream. \n\nIt's the way you whisper. \nIt drags me under and takes me home."
          ],
          [
            "name" => "Hush",
            "slug" => "hush",
            'albums' => ['72826' => 2, 'opiate' => 2],
            'lyrics' => "I can't say what I want to, even if I'm not serious.\n\nThings like.... Fuck yourself, kill yourself, you piece of shit. People tell me what to say, what to think, and what to play.\n\nI say...Go fuck yourself, you piece of shit. Why don't you go kill yourself? Just kidding."
          ],
          [
            'name' => 'Part of Me',
            'slug' => 'part-of-me',
            'albums' => ['72826' => 3, 'opiate' => 3]
          ],
          [
            'name' => 'Cold and Ugly',
            'slug' => 'cold-and-ugly',
            'albums' => ['72826' => 1, 'opiate' => 4]
          ],
          [
            'name' => 'Jerk-Off',
            'slug' => 'jerk-off',
            'albums' => ['72826' => 6, 'opiate' => 5]
          ],
          [
            'name' => 'Opiate',
            'slug' => 'opiate',
            'albums' => ['opiate' => 6]
          ],
          [
            'name' => 'The Gaping Lotus Experience',
            'slug' => 'gaping-lotus-experience',
            'albums' => ['opiate' => 7],
            'hidden' => true
          ],
          [
            'name' => 'Intolerance',
            'slug' => 'intolerance',
            'albums' => ['undertow' => 1]
          ],
          [
            'name' => 'Prison Sex',
            'slug' => 'prison-sex',
            'albums' => ['undertow' => 2]
          ],
          [
            'name' => 'Sober',
            'slug' => 'sober',
            'albums' => ['72826' => 5, 'undertow' => 3]
          ],
          [
            'name' => 'Bottom',
            'slug' => 'bottom',
            'albums' => ['undertow' => 4]
          ],
          [
            'name' => 'Crawl Away',
            'slug' => 'crawl-away',
            'albums' => ['72826' => 4, 'undertow' => 5]
          ],
          [
            'name' => 'Swamp Song',
            'slug' => 'swamp-song',
            'albums' => ['undertow' => 6]
          ],
          [
            'name' => 'Undertow',
            'slug' => 'undertow',
            'albums' => ['undertow' => 7]
          ],
          [
            'name' => '4 Degrees',
            'slug' => '4-degrees',
            'albums' => ['undertow' => 8]
          ],
          [
            'name' => 'Flood',
            'slug' => 'flood',
            'albums' => ['undertow' => 9]
          ],
          [
            'name' => 'Disgustipated',
            'slug' => 'disgustipated',
            'albums' => ['undertow' => 10]
          ],
          [
            'name' => 'Stinkfist',
            'slug' => 'stinkfist',
            'albums' => ['aenima' => 1]
          ],
          [
            'name' => 'Eulogy',
            'slug' => 'eulogy',
            'albums' => ['aenima' => 2]
          ],
          [
            'name' => 'H.',
            'slug' => 'h',
            'albums' => ['aenima' => 3]
          ],
          [
            'name' => 'Useful Idiot',
            'slug' => 'useful-idiot',
            'albums' => ['aenima' => 4]
          ],
          [
            'name' => 'Forty Six & 2',
            'slug' => 'fourty-six-and-2',
            'albums' => ['aenima' => 5]
          ],
          [
            'name' => 'Message to Harry Manback',
            'slug' => 'message-to-harry-manback',
            'albums' => ['aenima' => 6]
          ],
          [
            'name' => 'Hooker with a Penis',
            'slug' => 'hooker-with-a-penis',
            'albums' => ['aenima' => 7]
          ],
          [
            'name' => 'intermission',
            'slug' => 'intermission',
            'albums' => ['aenima' => 8]
          ],
          [
            'name' => 'Jimmy',
            'slug' => 'jimmy',
            'albums' => ['aenima' => 9]
          ],
          [
            'name' => 'Die Eier von Satan',
            'slug' => 'die-eier-von-satan',
            'albums' => ['aenima' => 10]
          ],
          [
            'name' => 'Pushit',
            'slug' => 'pushit',
            'albums' => ['aenima' => 11]
          ],
          [
            'name' => 'Cesaro Summability',
            'slug' => 'cesaro-summability',
            'albums' => ['aenima' => 12]
          ],
          [
            'name' => 'Aenema',
            'slug' => 'aenema',
            'albums' => ['aenima' => 13]
          ],
          [
            'name' => '(-) Ions',
            'slug' => 'ions',
            'albums' => ['aenima' => 14]
          ],
          [
            'name' => 'Third Eye',
            'slug' => 'third-eye',
            'albums' => ['aenima' => 15]
          ],
          [
            'name' => 'Message to Harry Manback II',
            'slug' => 'message-to-harry-manback-ii',
            'albums' => ['salival' => 4]
          ],
          [
            'name' => 'You Lied',
            'slug' => 'you-lied',
            'albums' => ['salival' => 5]
          ],
          [
            'name' => 'Merkaba',
            'slug' => 'merkaba',
            'albums' => ['salival' => 6]
          ],
          [
            'name' => 'No Quarter',
            'slug' => 'no-quarter',
            'albums' => ['salival' => 7]
          ],
          [
            'name' => 'LAMC',
            'slug' => 'lamc',
            'albums' => ['salival' => 8]
          ],
          [
            'name' => "Maynard's Dick",
            'slug' => 'maynards-dick',
            'albums' => ['salival' => 9],
            'hidden' => true
          ],
          [
            'name' => 'The Grudge',
            'slug' => 'the-grudge',
            'albums' => ['lateralus' => 1]
          ],
          [
            'name' => 'Eon Blue Apocalypse',
            'slug' => 'eon-blue-apocalypse',
            'albums' => ['lateralus' => 2]
          ],
          [
            'name' => 'The Patient',
            'slug' => 'the-patient',
            'albums' => ['lateralus' => 3]
          ],
          [
            'name' => 'Mantra',
            'slug' => 'mantra',
            'albums' => ['lateralus' => 4]
          ],
          [
            'name' => 'Schism',
            'slug' => 'schism',
            'albums' => ['lateralus' => 5]
          ],
          [
            'name' => 'parabol',
            'slug' => 'parabol',
            'albums' => ['lateralus' => 6]
          ],
          [
            'name' => 'parabola',
            'slug' => 'parabola',
            'albums' => ['lateralus' => 7]
          ],
          [
            'name' => 'Ticks & Leeches',
            'slug' => 'tickes-and-leeches',
            'albums' => ['lateralus' => 8]
          ],
          [
            'name' => 'Lateralus',
            'slug' => 'lateralus',
            'albums' => ['lateralus' => 9]
          ],
          [
            'name' => 'Disposition',
            'slug' => 'Disposition',
            'albums' => ['lateralus' => 10]
          ],
          [
            'name' => 'Reflection',
            'slug' => 'reflection',
            'albums' => ['lateralus' => 11]
          ],
          [
            'name' => 'Triad',
            'slug' => 'triad',
            'albums' => ['lateralus' => 13]
          ],
          [
            'name' => 'Faaip de Oiad',
            'slug' => 'faaip-de-oiad',
            'albums' => ['lateralus' => 14]
          ],
          [
            'name' => 'Vicarious',
            'slug' => 'Vicarious',
            'albums' => ['10000-days' => 1]
          ],
          [
            'name' => 'Jambi',
            'slug' => 'Jambi',
            'albums' => ['10000-days' => 2]
          ],
          [
            'name' => 'Wings for Marie (Pt 1)',
            'slug' => 'wings-for-marie',
            'albums' => ['10000-days' => 3]
          ],
          [
            'name' => '10,000 Days (Wings Pt 2)',
            'slug' => '10000-days-part-2',
            'albums' => ['10000-days' => 4]
          ],
          [
            'name' => 'The Pot',
            'slug' => 'the-pot',
            'albums' => ['10000-days' => 5]
          ],
          [
            'name' => 'Lipan Conjuring',
            'slug' => 'lipan-conjuring',
            'albums' => ['10000-days' => 6]
          ],
          [
            'name' => 'Lost Keys (Blame Hofmann)',
            'slug' => 'lost-keys',
            'albums' => ['10000-days' => 7]
          ],
          [
            'name' => 'Rosetta Stoned',
            'slug' => 'rosetta-stoned',
            'albums' => ['10000-days' => 8]
          ],
          [
            'name' => 'Intension',
            'slug' => 'intension',
            'albums' => ['10000-days' => 9]
          ],
          [
            'name' => 'Right in Two',
            'slug' => 'right-in-two',
            'albums' => ['10000-days' => 10]
          ],
          [
            'name' => 'Virginti Tres',
            'slug' => 'virginit-tres',
            'albums' => ['10000-days' => 11]
          ]
        ];

        $toolBandId = Band::where('slug', 'tool')->get()->first()->id;
        $opiateId = Album::where('slug', 'opiate')->get()->first()->id;
        $undertowId = Album::where('slug', 'undertow')->get()->first()->id;
        $demoId = Album::where('slug', '72826')->get()->first()->id;
        $salivalId = Album::where('slug', 'salival')->get()->first()->id;
        $aenimaId = Album::where('slug', 'aenima')->get()->first()->id;
        $lateralusId = Album::where('slug', 'lateralus')->get()->first()->id;
        $tenThousandDaysId = Album::where('slug', '10000-days')->get()->first()->id;

        foreach($songs as $song) {
          $albums = array_key_exists('albums', $song) ? $song['albums'] : array();
          $hasLyrics = array_key_exists('lyrics', $song);
          $lyrics = $hasLyrics ? $song['lyrics'] : null;

          $bacon = Song::create([
            "name" => $song['name'],
            "slug" => $song['slug'],
            "band_id" => $toolBandId,
            "has_lyrics" => $hasLyrics,
            "lyrics" => $lyrics
          ]);

          if (is_array($albums) && count($albums) > 0) {

            foreach($albums as $aSlug => $sOrder) {
              $albumId = $tenThousandDaysId;
              $songId = $bacon->id;
              $isHidden = array_key_exists('hidden', $song) ? $song['hidden'] == true : false;

              if ($aSlug == '72826') {
                $albumId = $demoId;
              } else if ($aSlug == 'opiate') {
                $albumId = $opiateId;
              } else if ($aSlug == 'undertow') {
                $albumId = $undertowId;
              } else if ($aSlug == 'salival') {
                $albumId = $salivalId;
              } else if ($aSlug == 'aenima') {
                $albumId = $aenimaId;
              } else if ($aSlug == 'lateralus') {
                $albumId = $lateralusId;
              }

              DB::table('songs_albums')->insert([
                  'album_id' => $albumId,
                  'song_id' => $songId,
                  'order' => $sOrder,
                  'is_hidden' => $isHidden
              ]);
            }
          }
        }
    }
}
