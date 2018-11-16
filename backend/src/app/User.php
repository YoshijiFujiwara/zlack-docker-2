<?php

namespace App;

use App\Model\Channel;
use App\Model\Message;
use App\Model\Workspace;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * workspacePolicyに必要
     * ワークスペースに所属しているか
     */
    public function participatedInWorkspace(Workspace $workspace)
    {
        $workspaceUsers = $workspace->users;
        foreach ($workspaceUsers as $workspaceUser) {
            if ($this->id === $workspaceUser->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * MessagePolicy
     * そのメッセージを書いたか
     */
    public function hasTheMessage(Message $message)
    {
        return $this->id == $message->user->id;
    }

    // JWTに必要
    public function getJWTIdentifier()
    {
        // ユーザーのプライマリーキーを返す
        return $this->getKey();
    }

    // JWTに必要
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class);
    }

    /**
     * 自分あてのメッセージ
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }

    /**
     * 自分が書いたメッセージ
     */
    public function wroteMessages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * スターを付けたメッセージ
     */
    public function starMessages()
    {
        return $this->belongsToMany(Message::class, 'stars', 'user_id', 'message_id');
    }
}
