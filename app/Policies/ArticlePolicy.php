<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Publication;
use App\Models\User;

class ArticlePolicy
{
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, Article $article): bool
    {
        return $user->subscriptions
            ->contains(
                fn (Publication $relatedPublication) => $relatedPublication->id === $article->publication_id
            );
    }

    public function create(): bool
    {
        return false;
    }

    public function update(): bool
    {
        return false;
    }

    public function delete(): bool
    {
        return false;
    }

    public function restore(): bool
    {
        return false;
    }

    public function forceDelete(): bool
    {
        return false;
    }
}
