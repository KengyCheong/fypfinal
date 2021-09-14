<?php

namespace Database\Seeders;

use App\Models\VaccineTag;
use Illuminate\Database\Seeder;

class VaccineTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = [
            [
                'vaccine_status' => 'Not Yet Implanted',
            ],
            [
                'vaccine_status' => '1st Dose Completed',
            ],
            [
                'vaccine_status' => '2nd Dose Completed',
            ],
        ];

        VaccineTag::insert($tag);

    }
}
