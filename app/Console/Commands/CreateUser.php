<?php

namespace App\Console\Commands;

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Console\Command;

class CreateUser extends Command
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
    protected $description = 'Create a user.';

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
        $name = $this->ask('Username');
        $email = $this->ask('Email');
        $isAdmin = $this->askWithCompletion('Has admin privileges', ['yes', 'no'], 'no') === 'yes' ? true : false;
        $password = $this->secret('Password');

        if ($this->confirm('Do you wish to continue?')) {
            RegisterController::createUser(compact('name', 'email', 'password'), $isAdmin);

            $this->info('User created.');
        }
    }
}
