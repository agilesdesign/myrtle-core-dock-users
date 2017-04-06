<?php

namespace Myrtle\Core\Users\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Myrtle\Core\Users\Models\User;
use Myrtle\Core\Users\Models\UserEmail;

class CreateUserCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new user';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$bar = $this->output->createProgressBar(6);

		do {
			$email['address'] = $this->askForEmail();
		} while (empty($email['address']));

		$bar->advance();
		$this->line('');

		$name['first'] = $this->ask('First name?');

		$bar->advance();
		$this->line('');

		$name['last'] = $this->ask('Last Name?');

		$bar->advance();
		$this->line('');

		$user['password'] = bcrypt($this->secret('Password'));

		$bar->advance();
		$this->line('');

		$this->comment('Creating user...');

		$user = User::create($user);

		$bar->advance();
		$this->line('');

		$this->comment('User created...');

		$user->name()->create($name);

		$user->emails()->create($email);

		$bar->finish();
	}

	protected function askForEmail()
	{
		$email = $this->ask('Email address?');

		if (UserEmail::where('address', $email)->get()->count()) {
			$this->error('A user with this email address already exists.');
			$this->line('');
			$this->comment('Please enter a different email for the new user.');

			if (Str::lower($this->ask('Would you like to enter a different email address? (y/n)')) === 'n') {
				$this->warn('Goodbye!');
				exit;
			}

			return false;
		}

		return $email;
	}

}
