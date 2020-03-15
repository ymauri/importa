<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * the imp_city is large, we need to break it in parts
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('imp_state')->truncate();
        DB::table('imp_city')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $cities = [];
        $csv = fopen(base_path('database/seeds/data/').'worldcities.csv', "r");
        if ($csv) {
            while ($data = fgetcsv($csv, 100, ",")) {
                if (isset($data[7]) && isset($data[5]) && isset($data[0])) {
                    $country = DB::table('imp_country')->where('code',  $data[5])->first();
                    if (!empty($country)) {
                        $state = DB::table('imp_state')->where( "name", $data[7])->where("id_country", $country->id)->first();
                        if (empty($state)) {
                            $state = DB::table('imp_state')->insert([
                                "name" => $data[7],
                                "id_country" => $country->id
                            ]);
                        }
                        if (!empty($state->id)) {
                            DB::table('imp_city')->insert([
                                "name" => $data[0],
                                "id_state" => $state->id
                            ]);
                        }
                    }
                }
            }
            fclose($csv);
        }
    }
}
