<?php

namespace App\Console\Commands\User;

use App\UseCases\Auth\RegisterService;
use Illuminate\Console\Command;
use App\User;

class VerifyCommand extends Command
{

    protected $signature = 'user:verify{email}';

    protected $description = 'Verify user email';

    private $service;


    public function __construct(RegisterService $service)
    {
        parent::__construct();

        $this->service = $service;
    }


    public function handle(): bool
    {
        $email = $this->argument('email');

        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);
            return false;
        }
        try {
            $this->service->verify($user->id);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }
        $this->info('User is successfully verified');
        return true;
    }
}
