<?php

namespace App\Providers;

use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-post', function(User $user, Post $post){
            return $user->role === 'admin' || $user->id === $post->creator_id;
        });

        Gate::define('delete-post', function(User $user, Post $post){
            return $user->role === 'admin' || $user->id === $post->creator_id;
        });
    }
}
