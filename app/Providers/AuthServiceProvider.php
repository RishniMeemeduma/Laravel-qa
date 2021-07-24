<?php

namespace App\Providers;

use App\Models\Question;
use App\Policies\QuestionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // \Gate::define('update-question',function($user,$question){
        //    return $user->id == $question->user_id;
        // });

        // \Gate::define('delete-question',function($user,$question){
        //     return $user->id == $question->user_id;
        // });
        //
    }
}
