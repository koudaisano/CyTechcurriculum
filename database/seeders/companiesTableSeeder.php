<?php

namespace Database\Seeders;

use App\Models\Companie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class companiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('companies')->insert([
        [
            'company_name' => 'Coca-Cola',
            'street_address' => null,
            'representative_name' => null,
        ],
        [
            'company_name' => 'サントリー',
            'street_address' => null,
            'representative_name' => null,
        ],
        [
            'company_name' => 'キリン',
            'street_address' => null,
            'representative_name' => null,
        ],
        [
            'company_name' => '伊藤園',
            'street_address' => null,
            'representative_name' => null,
        ],


       ]);
    }
}
