<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Schema;
use App\Models\Tag;

class PostAdminController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {

        $post = $this->post->create($request->all());
        $post->tags()->sync($this->getTagsIds($request->targs));

        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('admin.posts.edit', compact('post'));
    }

    public function update($id, PostRequest $request)
    {
        $this->post->find($id)->update($request->all());
        $post = $this->post->find($id);
        $post->tags()->sync($this->getTagsIds($request->tags));

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        Schema::disableForeignKeyConstraints();

        $this->post->find($id)->delete();

        Schema::enableForeignKeyConstraints();

        return redirect()->route('admin.index');
    }

    private function getTagsIds($tags)
    {
        $tagList = array_filter(array_map('trim', explode(', ', $tags)));
        $tagsIDs = [];
        foreach($tagList as $name)
        {
            $tagsIDs[] = Tag::firstOrCreate(['name' => $name])->id;
        }

        return $tagsIDs;
    }
}