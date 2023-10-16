<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

uses(TestCase::class, CreatesApplication::class, RefreshDatabase::class)
    ->in('Unit', 'Feature');


/**
 * @param bool $isAdmin
 * @return User|Collection|Model
 */
function createUser(bool $isAdmin = false): User|Collection|Model
{
    return User::factory()->create([
        'is_admin' => $isAdmin
    ]);
}
