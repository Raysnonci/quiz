<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Support\ServiceProvider;

class CustomUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            Str::contains($this->firstCredentialKey($credentials), 'user_password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'user_password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['user_password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

    // public function retrieveByCredentials(array $credentials)
    // {
    //     if (empty($credentials) ||
    //        (count($credentials) === 1 &&
    //         array_key_exists('user_pass', $credentials))) {
    //         return;
    //     }

    //     // First we will add each credential element to the query as a where clause.
    //     // Then we can execute the query and, if we found a user, return it in a
    //     // Eloquent User "model" that will be utilized by the Guard instances.
    //     $query = $this->createModel()->newQuery();

    //     foreach ($credentials as $key => $value) {
    //         if (Str::contains($key, 'user_pass')) {
    //             continue;
    //         }

    //         if (is_array($value) || $value instanceof Arrayable) {
    //             $query->whereIn($key, $value);
    //         } else {
    //             $query->where($key, $value);
    //         }
    //     }

    //     return $query->first();
    // }

    // /**
    //  * Validate a user against the given credentials.
    //  *
    //  * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    //  * @param  array  $credentials
    //  * @return bool
    //  */
    // public function validateCredentials(UserContract $user, array $credentials)
    // {
    //     $plain = $credentials['user_pass'];

    //     return $this->hasher->check($plain, $user->getAuthPassword());
    // }

    // public function boot()
    // {
    //     $this->registerPolicies();

    //     $this->app->auth->provider('custom', function ($app, $config) {
    //         return new CustomUserProvider($app['hash'], $config['model']);
    //     });
    // }
}
