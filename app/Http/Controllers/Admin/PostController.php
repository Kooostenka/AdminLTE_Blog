<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }


    public function store(StoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->validated();

            if(isset($data['tag_ids'])){
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            if(isset($data['preview_image'])){
                $data['preview_image'] = Storage::put('/images', $data['preview_image']);;
            }

            if(isset($data['main_image'])){
                $data['main_image'] = Storage::put('/images', $data['main_image']);
            }

            $post = Post::firstOrCreate($data);

            if(isset($tagIds)){
                $post->tags()->attach($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('admin.post.index');
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.show', compact('post'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }


    public function update(StoreRequest $request, Post $post)
    {
        try{
            DB::beginTransaction();
            $data = $request->validated();

            if(isset($data['tag_ids'])){
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            if(isset($data['preview_image'])){
                $data['preview_image'] = Storage::put('/images', $data['preview_image']);;
            }

            if(isset($data['main_image'])){
                $data['main_image'] = Storage::put('/images', $data['main_image']);
            }

            if(isset($tagIds)){
                $post->tags()->sync($tagIds);
            }

            $post->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return view('admin.post.show', compact('post'));

    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        dd('Restore');
    }
}
