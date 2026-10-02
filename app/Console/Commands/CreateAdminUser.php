<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin
                            {--name= : The administrator name}
                            {--email= : The administrator email address}
                            {--password= : The administrator password (min. 8 characters)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an administrator account for the admin panel';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $attributes = [
            'name' => $this->option('name') ?? text('Name', required: true),
            'email' => $this->option('email') ?? text('Email', required: true),
            'password' => $this->option('password') ?? password('Password (min. 8 characters)', required: true),
        ];

        $validator = Validator::make($attributes, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->components->error($error);
            }

            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $attributes['email']],
            ['name' => $attributes['name'], 'password' => $attributes['password']],
        );

        $this->components->info(
            ($user->wasRecentlyCreated ? 'Administrator created: ' : 'Administrator updated: ').$user->email
        );

        return self::SUCCESS;
    }
}
