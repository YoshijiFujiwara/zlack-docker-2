<?php

namespace App\Policies;

use App\Model\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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

    // そのメッセージを投稿した本人なら、メッセージを編集できる
    public function update(User $user, Message $message)
    {
        return $user->hasTheMessage($message);
    }
}
