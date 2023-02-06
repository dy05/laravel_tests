<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class Logout
{
    /**
     * @param null $_
     * @param array{} $args
     * @return User|null
     */
    public function __invoke($_, array $args): ?User
    {
        $guard = Auth::guard('web');

        /** @var User $user */
        $user = $guard->user();

        if ($user) {
            $guard->logout();
        }

        return $user;
    }
}
