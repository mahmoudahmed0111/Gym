<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $data = Post::latest()->get();
        return view("dashboard.posts.index", compact("data"));
    }


    public function show($id)
    {
        $data = Post::find($id);
        return view("dashboard.posts.show", compact("data"));
    }





    public function destroy($id)
    {
        $admin = Post::find($id);
        $admin->delete();
        return redirect(route('posts.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $admin = Post::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }

}
