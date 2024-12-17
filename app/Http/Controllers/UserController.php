<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    //
    public function index()
    {
//        $user = User::all();
        $user = User::with('posts')->get();
        foreach ($user as $u) {

            $u->content = $u->posts->where('content', 'LIKE', '%cum%' );
            $u->title = $u->posts->where('title', 'LIKE', '%quam%' );
        }
        return response()->json($user);
    }

    public function show($id)
    {
        try {
            $user = User::with(['profile', 'roles', 'posts'])->findOrFail($id);
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function getUserPost($id)
    {
        $user = User::with('posts')->find($id);
        return response()->json($user);
    }

    public function getLatestPostByUser($id)
    {

        $check = User::find($id)->posts()->latest()->first();


        $user = User::with('latestPost')->find($id);

        return response()->json(['check' => $check, 'user' => $user]);
//        return response()->json($user);
    }

    public function getOldestPostByUser($id)
    {
        $user = User::with('oldestPost')->find($id);
        return response()->json($user);
    }


    public function getRole()
    {
        $data = Role::with('users')->get();
        return response()->json($data);
    }


    public function getCountryById($id)
    {
        try {
            $data = Country::with('throughData')->find($id);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getImagesByUser($id)
    {
//        $data = Image::with('imageable')->get();
//        return response()->json($data);
        try {
            // Retrieve the associated image for a user
            $user = User::find($id);
            $image = $user->image;
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

    }

    public function getImagesByPost($id)
    {
        try {
            $data = Post::find($id);
            $image = $data->image;
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function addNewPostToUser()
    {

        $user = User::find(53);
        $post = new Post();
        $post->title = 'New Post';
        $post->content = 'New Post Content';
        $user->posts()->save($post);
        return response()->json($user);
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Delete the related profile
            if ($user->profile) {
                $user->profile->delete();
            }

            // Delete the user
            $user->delete();

            return response()->json(['message' => 'User and related profile deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function example()
    {

        $posts = Post::withCount('comments')->get();
        echo $posts[0]->comments_count;
    }
}
