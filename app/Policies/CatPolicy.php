<?php

namespace App\Policies;

use App\Models\Cat;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Carbon\Carbon;

class CatPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $startHour = 9;
        $endHour = 24;
        $currentHour = Carbon::now()->hour;

        // Si el usuario no está dentro del rango de horas permitido, denegar el acceso
        if ($currentHour < $startHour || $currentHour >= $endHour) {
            return false;
        }

        return $user->hasThisPermission('view any cat');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cat $cat): bool
    {
        return ($user->isYourCat($cat) && $user->hasThisPermission('view cat')) || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->hasThisPermission('create cat');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cat $cat): bool
    {
        return ($user->isYourCat($cat) && $user->hasThisPermission('update cat')) || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cat $cat): bool
    {
        return ($user->isYourCat($cat) && $user->hasThisPermission('delete cat')) || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cat $cat): bool
    {
        return $user->isYourCat($cat) && $user->isAdmin() && $user->hasThisPermission('restore cat');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cat $cat): bool
    {
        return $user->isYourCat($cat) && $user->isAdmin() && $user->hasThisPermission('force delete cat');
    }

}
