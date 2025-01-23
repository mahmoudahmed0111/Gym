<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $img = json_decode($this->img, true);

        if (is_array($img)) {
            $imgPaths = [];
            for ($i = 0; $i < count($img); $i++) {
                $imgPaths[] = url("storage/" . $img[$i]['path']);
            }
            $this->img = $imgPaths;
        } else {
            $this->img = [];
        }

        // Check if the authenticated user has liked the post
        $user = Auth::user();
        $liked = false;

        if ($user) {
            $liked = $this->likes->contains('user_id', $user->id);
        }
        $post=PostResource::collection(Post::where("id",$this->share_id)->get())[0] ??null;

        return [
            'id' => $this->id,
            'text' => $this->text,
            'img' => $this->img,
            'video' =>$this->video? url("storage/" . $this->video):null,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'share_post' => $post,
            'likes' => $this->likes->count(),
            'liked' => $liked,
            'user' => new UserResource($this->user),
        ];
    }
}
