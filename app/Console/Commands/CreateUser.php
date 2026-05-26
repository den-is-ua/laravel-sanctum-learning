<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Pest\Support\Str;

#[Signature('user:create')]
#[Description('Command description')]
class CreateUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = Str::random(3);
        User::created([
            'email' => $name,
            'name' => $name,
            'password' => Hash::make($name)
        ]);
        
        $this->info('Created new user with name/password - ' . $name);
        
        return self::SUCCESS;
    }
}
