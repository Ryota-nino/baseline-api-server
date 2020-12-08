<?php

namespace App\Policies;

use App\Models\CompanyInformation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CompanyInformation $companyInformation
     * @return mixed
     */
    public function view(User $user, CompanyInformation $companyInformation)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CompanyInformation $companyInformation
     * @return mixed
     */
    public function update(User $user, CompanyInformation $companyInformation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CompanyInformation $companyInformation
     * @return mixed
     */
    public function delete(User $user, CompanyInformation $companyInformation)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CompanyInformation $companyInformation
     * @return mixed
     */
    public function restore(User $user, CompanyInformation $companyInformation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CompanyInformation $companyInformation
     * @return mixed
     */
    public function forceDelete(User $user, CompanyInformation $companyInformation)
    {
        //
    }
}
