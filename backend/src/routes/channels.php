<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// ドキュメントの抜粋（今回は設定しないため）
// todo: 後でルートの認可を追加する
Broadcast::channel('createMessageChannel', function () {
    return true;
});

Broadcast::channel('updateMessageChannel', function () {
    return true;
});

Broadcast::channel('deleteMessageChannel', function () {
    return true;
});

Broadcast::channel('starChannel', function () {
    return true;
});


// そのユーザーがオンラインかどうかに使う
//Broadcast::channel('online', function($user) {
//    return $user;
//});
