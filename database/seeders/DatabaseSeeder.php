<?php

namespace Database\Seeders;

use App\Models\EBook;
use App\Models\Gender;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_id' => '0', 'role_desc' => 'Admin']);
        Role::create(['role_id' => '1', 'role_desc' => 'User']);

        Gender::create(['gender_id' => '0', 'gender_desc' => 'Male']);
        Gender::create(['gender_id' => '1', 'gender_desc' => 'Female']);

        EBook::create([
            'ebook_id' => '1',
            'title' => 'E-Book 1: Introduction to Web Programming',
            'author' => 'B!na Nusantara',
            'description' => 'A description for the book here.',
        ]);

        EBook::create([
            'ebook_id' => '2',
            'title' => 'E-Book 2: Intermediate Web Programming',
            'author' => 'B!na Nusantara',
            'description' => 'A description for the book here.',
        ]);

        EBook::create([
            'ebook_id' => '3',
            'title' => 'E-Book 3: Advanced Web Programming',
            'author' => 'B!na Nusantara',
            'description' => 'A description for the book here.',
        ]);

    }
}
