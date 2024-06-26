<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\Response;

class VacantePolicy
{
    /**
     * Determine whether the user can view any models.
     * 
     * Policy implementado en VacanteController->index() (v226)
     */
    public function viewAny(User $user)/* : bool */
    {
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vacante $vacante)/* : bool */
    {
        //
    }

    /**
     * Determine whether the user can create models.
     * 
     * Policy implementado en VacanteController->create() (v227)
     */
    public function create(User $user)/* : bool */
    {
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        // $user es instancia del modelo User con la info el usuario autenticado
        // $vacante es instancia de una vacante a editar
        // este metodo update() del Policy lo ejecutamos desde PostController->update() pasandole como argumento la instancia de la vacante a editar
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacante $vacante)/* : bool */
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vacante $vacante)/* : bool */
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vacante $vacante)/* : bool */
    {
        //
    }
}
