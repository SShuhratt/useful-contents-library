<?php
use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Genre;

class ContentGenreSeeder extends Seeder
{
    public function run()
    {
        $genres = Genre::all(); // Fetch all genres

        foreach (Content::all() as $content) {
            $content->genres()->attach($genres->random(2)->pluck('id')->toArray());
            // Attach 2 random genres to each content. Adjust as needed.
        }
    }
}
