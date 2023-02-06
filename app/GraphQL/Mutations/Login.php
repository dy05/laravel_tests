<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;

final class Login
{
    /**
     * @param null $_
     * @param array{} $args
     * @return User|null
     */
    public function __invoke($_, array $args): ?User
    {
        $guard = Auth::guard();

        if (! $guard->attempt($args)) {
            throw new Error('Invalid credentials');
        }

        /** @var User $user */
        $user = $guard->user();

        return $user;
    }
}
