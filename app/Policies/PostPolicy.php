<?php

namespace App\Policies;

use App\Models\CompanyInformation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

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
        // 投稿者本人の時編集可能
        return $this->isUserOwn($user, $companyInformation);
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
        // 管理者権限または投稿者本人の時削除できる
        return (
            Gate::allows('isAdmin') |
            $this->isUserOwn($user, $companyInformation)
        );
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

    private function isUserOwn(User $user, CompanyInformation $companyInformation)
    {
        return $user->id == $companyInformation->user_id;
    }
}
