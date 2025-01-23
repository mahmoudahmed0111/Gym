<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Hashtag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Get all posts
    public function index()
    {
        $posts = Post::where("video", null)->latest()->get();
        return PostResource::collection($posts);
    }
    public function reels()
    {
        $posts = Post::where("video", "!=", null)->latest()->get();
        return PostResource::collection($posts);
    }

    // Create a new post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'nullable|string',
            'img' => 'nullable|array',
            'share_id' => 'nullable|exists:posts,id',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv|max:20480', // max:20480 means max 20 MB
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->share_id) {
            $share_id = Post::find($request->share_id)->share_id;
            if ($share_id != null) {
                $request_share = $share_id;
            } else {
                $request_share = $request->share_id;
            }
            $postData = [
                'text' => $request->text,
                'user_id' => Auth::user()->id,
                'share_id' => $request_share,
            ];
            $post = Post::create($postData);
            preg_match_all('/#([\p{L}\p{N}_]+)/u', $request->input('text'), $matches);
            // ربط الهاشتاجات بالمنشور
            foreach ($matches[1] as $tag) {
                $hashtag = Hashtag::firstOrCreate(['tag' => $tag]);
                $post->hashtags()->attach($hashtag->id);
            }
        } else {
            if (!$request->has('img') && !$request->has('video') && !$request->text) {
                return response()->json(['errors' => "must be enter data"], 422);
            }

            $validated = $request->all();
            $validated["user_id"] = auth()->user()->id;
            if ($request->has('img')) {
                $validated["img"] = UploadMultiImage($request->img, "posts");
            }
            if ($request->has('video')) {
                $validated["video"] = UploadImage($request->video, "posts");
            }
            $post = Post::create($validated);
            preg_match_all('/#([\p{L}\p{N}_]+)/u', $request->input('text'), $matches);
            // ربط الهاشتاجات بالمنشور
            foreach ($matches[1] as $tag) {
                $hashtag = Hashtag::firstOrCreate(['tag' => $tag]);
                $post->hashtags()->attach($hashtag->id);
            }
        }
        return new PostResource($post);
    }

    // Get a single post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    // Update a post
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'text' => 'nullable|string',
            'img' => 'nullable|array',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv|max:20480', // max:20480 means max 20 MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Post::findOrFail($id);
        if ($request->has('img')) {
            $validated["img"] = UploadMultiImage($request->img, "posts");
        }
        if ($request->has('video')) {
            $validated["video"] = UploadImage($request->video, "posts");
        }
        $post->update($validated);
        $existingHashtags = $post->hashtags; // احصل على جميع الهاشتاجات المرتبطة حالياً
        $newHashtags = [];
        preg_match_all('/#(\w+)/', $request->input('text'), $matches);
        // إنشاء أو تحديث الهاشتاجات الجديدة وجمعها في مصفوفة
        foreach ($matches[1] as $tag) {
            $hashtag = Hashtag::firstOrCreate(['tag' => $tag]);
            $newHashtags[] = $hashtag->id;
        }
        // حذف الهاشتاجات التي لم تعد مرتبطة مع المنشور
        $detachHashtags = $existingHashtags->pluck('id')->diff($newHashtags);
        $post->hashtags()->detach($detachHashtags);
        // إضافة الهاشتاجات الجديدة إلى المنشور
        $post->hashtags()->sync($newHashtags);
        return new PostResource($post);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id == $post->user_id) {
            $post->delete();
        } else {
            return response()->json(['error' => 'You are not authorized to delete this post.'], 403);
        }

        return response()->json(['msg' => 'Post deleted successfully'], 200);
    }

    public function like(Request $request, Post $post)
    {
        $like = Like::where(['post_id' => $post->id, 'user_id' => auth()->user()->id])->first();
        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Post unliked successfully', 'like' => null], 200);
        } else {
            $like = Like::create([
                'post_id' => $post->id,
                'user_id' => $request->user()->id,
            ]);
            return response()->json(['message' => 'Post liked successfully', 'like' => $like], 201);
        }
    }

    public function searchByHashtag($tag)
    {
        // البحث عن الهاشتاج في قاعدة البيانات
        $hashtag = Hashtag::where('tag', $tag)->first();

        if ($hashtag) {
            // العثور على الهاشتاج، يمكنك تنفيذ العمليات المطلوبة هنا
            $posts = $hashtag->posts()->paginate(10);
            return PostResource::collection($posts);
        } else {
            // لم يتم العثور على الهاشتاج
            return sendResponse(404, 'Hashtag is not found');
        }
    }

    public function searchGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'query' => 'required',
            'type' => 'in:all,user,post,videos,research,tag', // Add validation for the search type (user or post)
        ]);

        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $query = $request->input('query');
            if (!$query) {
                return ["data" => []];
            }
            $type = $request->input('type');
            if ($type === 'user') {
                $results = User::where(function ($queryBuilder) use ($query) {
                    $keywords = explode(' ', $query);
                    foreach ($keywords as $keyword) {
                        $queryBuilder->where(function ($subQuery) use ($keyword) {
                            $subQuery
                                ->where('name', 'like', "%$keyword%")
                                ->orWhere('email', 'like', "%$keyword%")
                                ->orWhere('mobile', 'like', "%$keyword%");
                        });
                    }
                })
                    ->paginate(10);

                $results = UserResource::collection($results);
            } elseif ($type === 'post') {
                $userId = Auth::id();
                $results = Post::where('text', 'like', "%$query%")
                    ->orWhereHas('user', function ($subQuery) use ($query) {
                        $subQuery->where('name', 'like', "%$query%")
                            ->orwhere('email', 'like', "%$query%");
                    })
                    ->paginate(10);
                $results = PostResource::collection($results);
            } elseif ($type === 'tag') {
                $results = Hashtag::where('tag', 'like', "%$query%")->withCount('posts') // Assuming a relationship between Hashtag and Post exists
                    ->paginate(10);
            } elseif ($type === 'videos') {
                $results = Post::where('text', 'like', "%$query%")
                    ->where('video', "!=", null)
                    ->orWhereHas('user', function ($subQuery) use ($query) {
                        $subQuery->where('name', 'like', "%$query%")
                            ->orwhere('email', 'like', "%$query%");
                    })
                    ->where('video', "!=", null)
                    ->paginate(10);
                $results = PostResource::collection($results);
            } elseif ($type === 'all') {
                $posts = Post::where('text', 'like', "%$query%")
                    ->with('user.profile') // Assuming a relationship between Post and User exists
                    ->take(5)->get();
                $posts = PostResource::collection($posts);
                $users = User::where(function ($queryBuilder) use ($query) {
                    $keywords = explode(' ', $query);

                    foreach ($keywords as $keyword) {
                        $queryBuilder->where(function ($subQuery) use ($keyword) {
                            $subQuery
                                ->where('name', 'like', "%$keyword%")
                                ->orWhere('email', 'like', "%$keyword%")
                                ->orWhere('mobile', 'like', "%$keyword%");
                        });
                    }
                })
                    ->with("profile")
                    ->take(5)->get();
                $users = UserResource::collection($users);

                $tags = Hashtag::where('tag', 'like', "%$query%")->withCount('posts') // Assuming a relationship between Hashtag and Post exists
                    ->take(5)->get();
                $merge = [];
                foreach ($users as $user) {
                    $merge[] = $user;
                }
                foreach ($tags as $tag) {
                    $merge[] = $tag;
                }
                foreach ($posts as $post) {
                    $merge[] = $post;
                }
                $results = ["data" => $merge];
            } else {
                return response()->json([
                    'error' => 'Invalid search type',
                ], 422);
            }

            return $results;
        } catch (\Exception $e) {
            return sendResponse(500, "An error occurred: " . $e->getMessage(), null);
        }
    }
}


