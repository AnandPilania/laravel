<?php

use Illuminate\Database\Seeder;

class PromotionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Travel Insurance',
            'Telecom',
            'Miscellaneous',
        ];

        foreach ($types as $type) {
            DB::table('promotion_types')->insert(['name' => $type]);
        }
    }
}
