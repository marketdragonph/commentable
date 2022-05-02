<?php

namespace MarketDragon\Commentable;

use MarketDragon\Commentable\Exceptions\InvalidCommentModel;
use Illuminate\Support\ServiceProvider;

class CommentableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @throws InvalidCommentModel
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/commentable.php' => config_path('commentable.php'),
        ], 'config');

        $this->guardAgainstInvalidCommentModel();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/commentable.php', 'commentable');
    }

    /**
     * Make sure the given Comment model extends MarketDragon\Commentable\Comment
     *
     * @throws InvalidCommentModel
     */
    public function guardAgainstInvalidCommentModel()
    {
        $modelClassName = config('commentable.model');

        if (! is_a($modelClassName, Comment::class, true)) {
            throw InvalidCommentModel::create($modelClassName);
        }
    }
}
