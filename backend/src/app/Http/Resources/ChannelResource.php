<?php

namespace App\Http\Resources;

use App\Model\Workspace;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'messages' => MessageResource::collection($this->messages),
//            'workspace' => new WorkspaceResource($this->workspace),
        ];
    }
}
