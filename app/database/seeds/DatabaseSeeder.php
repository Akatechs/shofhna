<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('UsersTableSeeder');
		$this->command->info('User table seeded!');
                $this->call('CommunitiesTableSeeder');
		$this->command->info('Communities table seeded!');
		$this->call('PostsTableSeeder');
		$this->command->info('Posts table seeded!');
		
	}

}