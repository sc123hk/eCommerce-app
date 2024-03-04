<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Listing::create([
            'title' => 'Japan',
            'category' => 'Asia',
            'description' => 'Japan description',
            'price' => 8000,
            'quantity' => 4,
        ]);

        \App\Models\Listing::create([
            'title' => 'England',
            'category' => 'Europe',
            'description' => 'England description',
            'price' => 18000,
            'quantity' => 13,
        ]);

        \App\Models\Listing::create([
            'title' => 'United State',
            'category' => 'America',
            'description' => 'United State description',
            'price' => 26000,
            'quantity' => 20,
        ]);

        \App\Models\Listing::create([
            'title' => 'South Africa',
            'category' => 'Africa',
            'description' => 'South Africa description',
            'price' => 7000,
            'quantity' => 17,
        ]);
    }
}
