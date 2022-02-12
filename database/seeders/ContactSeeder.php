<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'name' => 'contact-one',
            'contact' => '111111111',
            'email' =>'contactone@test.com'
        ]);
        Contact::create([
            'name' => 'contact-two',
            'contact' => '222222222',
            'email' =>'contacttwo@test.com'
        ]);
    }
}
