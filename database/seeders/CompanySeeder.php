<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $companies = [
            ['company_name' => "PNC", 'company_logo' => 'logo.png', 'company_address' => 'Phnom penh', 'company_website' => 'www.PNC.com', 'company_email' => "PNC@gmail.com", "password"=>Hash::make("password")],
            ['company_name' => "ABA", 'company_logo' => 'logo.png', 'company_address' => 'Phnom penh', 'company_website' => 'www.ABA.com', 'company_email' => "ABA@gmail.com", "password"=>Hash::make("password")],
        ];
        DB::table('companies')->insert($companies);
    }
}
