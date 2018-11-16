<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkspaceCreateRequest;
use App\Http\Requests\WorkspaceUpdateRequest;
use App\Http\Resources\WorkspaceResource;
use App\Model\Channel;
use App\Model\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * 自分が所属しているワークスペースすべて
     */
    public function index(Request $request)
    {
        // 所属するワークスペース
        $workspaces = $request->user()->workspaces;
//        $workspaces = $request->user()->workspaces()->paginate(10);
        return WorkspaceResource::collection($workspaces);
    }

    public function store(WorkspaceCreateRequest $request)
    {
        $workspace = new Workspace;
        $workspace->name = $request->name;
        $workspace->save();
        $workspace->users()->attach($request->user()); // 作った本人はその時に追加しないとね

        // generalとrandomチャンネル作成
        $channel = new Channel;
        $channel->name = 'general';
        $channel->workspace()->associate($workspace); // このワークスペースに所属するように
        $workspace->channels()->save($channel);

        $channel = new Channel;
        $channel->name = 'random';
        $channel->workspace()->associate($workspace);
        $workspace->channels()->save($channel);

        return new WorkspaceResource($workspace);
    }

    public function show(Workspace $workspace)
    {
        // ワークスペースに参加しているユーザーのみ
        $this->authorize('show', $workspace); // workspacePolicyが発動
        return new WorkspaceResource($workspace);
    }

    public function update(WorkspaceUpdateRequest $request, Workspace $workspace)
    {
        // 今のところ、ワークスペースに参加しているユーザーのみ
        $this->authorize('update', $workspace); // workspacePolicyが発動
        $workspace->name = $request->get('name', $workspace->name);
        $workspace->save();
        return new WorkspaceResource($workspace);
    }
}
