<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an admin user';

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
        $role = Role::query()->where('role_name', '=', 'Admin')->first();

        if (empty($role->id)) {
            return 'admin role doesnt have an id, are you sure the admin role is created.';
        }

        $user = new User;
        $user->name = env('ADMIN_NAME');
        $user->email = env('ADMIN_EMAIL');
        $user->password = Hash::make(env('ADMIN_PASSWORD'));
        $user->role_id = $role->id;
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}
