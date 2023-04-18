<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('comment-delete', function($user, $comment) {
            return (($user->id == $comment->user_id) || ($user->id == $comment->article->user_id));
        });

        Gate::define('productComment-delete', function($user, $product_comment) {
            return (($user->id == $product_comment->user_id) || ($user->id == $product_comment->product->user_id));
        });

        Gate::define('content-delete', function($user, $content) {
            return $user->id == $content->user_id;
        });

        Gate::define('content-edit', function($user, $content) {
            return $user->id == $content->user_id;
        });

        Gate::define('is-admin', function($user) {
            return $user->status == 1;
        });

        Gate::define('is-user', function($user) {
            return $user->status == 0;
        });

        Gate::define('is-approved-user', function($user) {
            return $user->status == 2;
        });
    }
}
