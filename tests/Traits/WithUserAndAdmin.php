<?php

namespace Tests\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait WithUserAndAdmin
{

    private User $user;

    private User $admin;

    protected function createUserAndAdmin(): void
    {
        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
    }

    /**
     * @param bool $isAdmin
     * @return User|Collection|Model
     */
    private function createUser(bool $isAdmin = false): User|Collection|Model
    {
        return User::factory()->create([
            'is_admin' => $isAdmin
        ]);
    }

}
