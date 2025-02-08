<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AspirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aspiration::create([
            'id' => 'LA0001',
            'title' => 'My first aspiration',
            'slug' => 'my-first-aspiration',
            'institution' => 'Kementrian Pendidikan, Kebudayaan, Riset, dan Teknologi',
            'aspiration' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit orci ultricies, aenean malesuada fames vitae aliquet ultrices convallis placerat aptent dictum, viverra fringilla montes parturient hac conubia fermentum accumsan. Convallis tristique habitasse eget imperdiet turpis pharetra maecenas fusce, sociis etiam consequat risus litora rhoncus egestas suspendisse, pellentesque duis tempor viverra neque lacus hendrerit.',
            'date_occurred' => '2023-01-01',
            'location' => 'Location 1',
            'status' => 'pending',
            'attachment' => null,
            'user_id' => 2
        ]);

        Aspiration::create([
            'id' => 'LA0002',
            'title' => 'My second aspiration',
            'slug' => 'my-second-aspiration',
            'institution' => 'Kementrian Kesehatan',
            'aspiration' => 'Ornare dignissim nec leo pretium nullam quisque lectus, condimentum nisl massa laoreet vel mi euismod, a litora id mollis phasellus nisi. Nostra netus penatibus placerat eros praesent fermentum urna, ridiculus orci integer cras sed varius elementum, viverra vulputate phasellus interdum velit sem.',
            'date_occurred' => '2023-02-01',
            'location' => 'Location 2',
            'status' => 'proses',
            'attachment' => null,
            'user_id' => 2
        ]);
    }
}
