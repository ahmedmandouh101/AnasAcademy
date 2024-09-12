<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given product can be updated by the user.
     */
    public function update(User $user, Product $product)
    {
      
        return $user->id === $product->user_id || $user->is_admin;
    }

    /**
     * Determine if the given product can be deleted by the user.
     */
    public function delete(User $user, Product $product)
    {
       
        return $user->id === $product->user_id || $user->is_admin;
    }
}
