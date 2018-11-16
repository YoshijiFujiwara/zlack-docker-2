<?php

namespace App\Http\Controllers;

use App\Events\CreateMessageEvent;
use App\Events\DeleteMessageEvent;
use App\Events\UpdateMessageEvent;
use App\Http\Resources\MessageResource;
use App\Model\Channel;
use App\Model\Message;
use App\Model\Workspace;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
//    // 指定チャンネルのメッセージを昇順に取得する
//    public function indexInChannel(Request $request, Workspace $workspace, Channel $channel)
//    {
//        // todo: あとで、authorize
//
//        // 投稿先がチャンネルで、かつチャンネルidが一致するもの
//        $messages = Message::where([
//            ['messageable_type', '=', 'App\\Model\\Channel'],
//            ['messageable_id', '=', $channel->id],
//        ])->get();
//
//        return MessageResource::collection($messages);
//    }

    // 指定したユーザーとのDM内容を作成時刻の昇順で取得する
    public function indexInDM(Request $request, Workspace $workspace, User $user)
    {
        // todo: あとで、authorizationをadd

        // 投稿先がチャンネルで、かつチャンネルidが一致するもの。かつ、自分が投稿したもの
        $messages = Message::where([
                ['messageable_type', '=', 'App\\User'],
                ['user_id', '=', $user->id],
                ['messageable_id', '=', $request->user()->id]
            ])
            ->orWhere([
                ['messageable_type', '=', 'App\\User'],
                ['user_id', '=', $request->user()->id],
                ['messageable_id', '=', $user->id]
            ])
            ->oldestFirst()->get();

        return MessageResource::collection($messages);
    }

    // チャンネルにメッセージを投稿する
    public function storeToChannel(Request $request, Workspace $workspace, Channel $channel)
    {
        // todo: あとで、authorize入れる

        // メッセージ作成
        $message = new Message;
        $message->body = $request->body;
        $message->user()->associate($request->user()); // 投稿者の設定
        $channel->messages()->save($message); // チャンネルに対してメッセージを投稿する

        $newMessageResource = new MessageResource($message);

        // リアルタイム通知用のイベント作成
        broadcast(new CreateMessageEvent($newMessageResource))->toOthers();

        return $newMessageResource;
    }

    // todo: 後でアップデート用のリクエストを作成する
    public function update(Request $request, Workspace $workspace, Channel $channel, Message $message)
    {
        // 自分の投稿のメッセージのみ編集が出来るようなポリシーが必要
        $this->authorize('update', $message); // messagePolicyが必要

        $message->body = $request->get('body', $message->body);
        $message->save();

        $updatedMessageResource = new MessageResource($message);

        // リアルタイム通知用のイベント作成
        broadcast(new UpdateMessageEvent($updatedMessageResource))->toOthers();

        return $updatedMessageResource;
    }

    /**
     * チャンネル中のメッセージを削除する
     */
    public function destroy(Workspace $workspace, Channel $channel, Message $message)
    {
        // todo: あとでauthorizeを追加する
        // そのメッセージが指定されたチャンネルのものか
        // 自分のメッセージであるかどうか

//        $tmpMessage = $message;
        $message->delete();

//        broadcast(new DeleteMessageEvent(new MessageResource($tmpMessage)))->toOthers();

        return response(null, 204);
    }


    // 他のユーザーにDMを投稿する
    public function storeToDM(Request $request, Workspace $workspace, User $user)
    {
        // todo: あとで、authorize入れる
        // 同じワークスペースのメンバーでないと投稿出来ないように設定する
        

        // メッセージ作成
        $message = new Message;
        $message->body = $request->body;
        $message->user()->associate($request->user()); // 投稿者の設定
        $user->messages()->save($message); // ユーザーに対してメッセージを投稿する

        return new MessageResource($message);
    }
}
