<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,$article)
    {
        return $article->owner->id == $user->id ;
    }

    public function delete(User $user,$article)
    {
        return $article->owner->id == $user->id ;
    }
}
