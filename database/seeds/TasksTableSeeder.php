<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();

        $initial_date = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('tasks')->insert([
	                        	[
	                        		'name' => 'Nome', 
	                        		'description' => 'Descrição', 
	                        		'initial_date' => $initial_date, 
	                        		'status_id'=>1, 
	                        		'active'=>true, 
	                        		'created_at'=>$initial_date
	                        	]
                        	]
                        );
    }
}
