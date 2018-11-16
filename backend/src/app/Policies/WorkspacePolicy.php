<?php

namespace App\Policies;

use App\Model\Workspace;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
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

    // ワークスペースの所属人なら見れるように
    public function show(User $user, Workspace $workspace)
    {
        return $user->participatedInWorkspace($workspace);
    }

    /**
     * todo: 今はワークスペースに所属している人なら変えられるようになっている
     * あとで、ワークスペースオーナーだけが変えれるように変更すべき
     */
    public function update(User $user, Workspace $workspace)
    {
        return $user->participatedInWorkspace($workspace);
    }

    // ワークスペースの所属人なら見れるように
    public function showChannel(User $user, Workspace $workspace)
    {
        return $user->participatedInWorkspace($workspace);
    }

    // ワークスペースの所属人なら追加できる
    public function storeChannel(User $user, Workspace $workspace)
    {
        return $user->participatedInWorkspace($workspace);
    }
}
