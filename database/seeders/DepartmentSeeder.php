<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'short' => 'RL WRO',
                'name' => 'Real Logistics',
                'legal_form' => 'Sp. z o.o. Sp. K.',
                'street' => 'Muchoborska 16',
                'postal_code' => '54-424',
                'city' => 'Wrocław',
                'country' => 'Poland',
                'logo' => 'rl.png',
                'vat_id' => 'PL8943057791',
                'regon' => '360250666',
                'krs' => '0000533792',
                'aeo' => 'PLAEOF450000190107',
                'fmc' => 'NVOCC 028857',
                'phone' => '0048 71 349 68 18'
            ],
            [
                'short' => 'RL GDY',
                'name' => 'Real Logistics',
                'legal_form' => 'Sp. z o.o. Sp. K.',
                'street' => 'Śląska 35/37',
                'postal_code' => '81-310',
                'city' => 'Gdynia',
                'country' => 'Poland',
                'logo' => 'rl.png',
                'vat_id' => 'PL8943057791',
                'regon' => '360250666',
                'krs' => '0000533792',
                'aeo' => 'PLAEOF450000190107',
                'fmc' => 'NVOCC 028857',
                'phone' => '0048 58 731 13 95'
            ],
            [
                'short' => 'RL WAW',
                'name' => 'Real Logistics',
                'legal_form' => 'Sp. z o.o. Sp. K.',
                'street' => 'Gabriela 4',
                'postal_code' => '01-347',
                'city' => 'Warszawa',
                'country' => 'Poland',
                'logo' => 'rl.png',
                'vat_id' => 'PL8943057791',
                'regon' => '360250666',
                'krs' => '0000533792',
                'aeo' => 'PLAEOF450000190107',
                'fmc' => 'NVOCC 028857',
                'phone' => '0048 22 379 26 42'
            ],
            [
                'short' => 'RLT',
                'name' => 'RL Transport',
                'legal_form' => 'Sp. z o.o.',
                'street' => 'Muchoborska 16',
                'postal_code' => '54-424',
                'city' => 'Wrocław',
                'country' => 'Poland',
                'logo' => 'rlt.png',
                'vat_id' => 'PL8943131990',
                'regon' => '381146352',
                'krs' => '0000746599',
                'aeo' => 'PLAEOF450000190107',
                'fmc' => 'NVOCC 028857',
                'phone' => '0048 71 349 68 18'
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
