<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('status')->truncate();

    	$created_at = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('status')->insert([
                        	['status' => 'Pendente', 'created_at' => $created_at],
                        	['status' => 'Em desenvolvimento', 'created_at' => $created_at],
                        	['status' => 'Em teste', 'created_at' => $created_at],
                        	['status' => 'Concluído', 'created_at' => $created_at]
                        	]
                        );
    }
}
