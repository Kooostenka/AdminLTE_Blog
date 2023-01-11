<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Tag\StoreRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }


    public function create()
    {
        return view('admin.tag.create');
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Tag::firstOrCreate($data);
        return redirect()->route('admin.tag.index');
    }


    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.show', compact('tag'));
    }


    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }


    public function update(StoreRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return view('admin.tag.show', compact('tag'));

    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tag.index');
    }

    public function restore($id)
    {
        $tag = Tag::withTrashed()->findOrFail($id);
        $tag->restore();
        dd('Restore');
    }
}
