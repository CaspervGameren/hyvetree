<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException('This admin seeder may only run locally or during testing.');
        }

        $this->call(RoleSeeder::class);

        $password = Str::password(20);

        $user = User::firstOrCreate(
            ['email' => 'admin@hyvetree.test'],
            [
                'name' => 'Hyvetree Admin',
                'password' => Hash::make($password),
            ],
        );

        $role = Role::where('name', 'admin')->firstOrFail();

        $user->roles()->syncWithoutDetaching([$role->id]);

        if ($user->wasRecentlyCreated) {
            $this->command?->info('Admin email: '.$user->email);
            $this->command?->info('Admin password: '.$password);
        } else {
            $this->command?->info('Admin role linked. The existing password was not changed.');
        }
    }
}
