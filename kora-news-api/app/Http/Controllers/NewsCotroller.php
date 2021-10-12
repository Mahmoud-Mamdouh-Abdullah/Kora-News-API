<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\NewsTag;
use App\Models\Tag;
use Symfony\Contracts\Service\Attribute\Required;

class NewsCotroller extends Controller
{

    function index()
    {
        $news = News::with('images')->with('tags')->with('user')->paginate(3);
        return $news;
        //return view('news/index')->with('news_list', $news);
    }

    function sortDesc() {
        $news = News::with('images')->with('tags')->orderBy('title', 'desc')->paginate(3);
        return $news;
        //return view('news/index')->with('news_list', $news);
    }

    function sortAsc() {
        $news = News::with('images')->with('tags')->orderBy('title', 'asc')->paginate(3);
        return $news;
        //return view('news/index')->with('news_list', $news);
    }

    function create()
    {
        return view('news.create')->with('tags', Tag::all());
    }

    function store(Request $request)
    {
        //return $request;
        //dd($request->all());
        $status = [];
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'images' => 'required',
            'tags' => 'required'
        ]);

        /*$image_paths = [];
        foreach ($request->file('images') as $image) {
            //$newName = time().rand(1,100) . '-' . $image->getClientOriginalName();
            array_push($image_paths, $image->store('images', ['disk' => 'public']));
        }*/

        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->user_id = 1;
        array_push($status,$news->save());


        $news_id = $news->id;
        foreach ($request->images as $path) {
            $image = new Image;
            $image->news_id = $news_id;
            $image->url = $path;
            array_push($status,$image->save());
        }

        foreach ($request->tags as $tag_id) {
            $tag = new NewsTag();
            $tag->news_id = $news_id;
            $tag->tag_id = $tag_id;
            array_push($status,$tag->save());
        }
        return $status;
    }

    function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit')->with(['news' => $news, 'tags' => Tag::all()]);
    }

    function update($id, Request $request)
    {
        //'images.*' => 'image|mimes:jpg,png,jpeg|max:5048',
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'images' => 'required',
            'tags' => 'required'
        ]);
        $news = News::findOrFail($id);
        $news->title = $request['title'];
        $news->content = $request['content'];
        $news->save();

        $images = Image::where('news_id', $id)->get();
        foreach ($images as $image) {
            $image->delete();
        }

        /*$image_paths = [];
        foreach ($request->file('images') as $image) {
            array_push($image_paths, $image->store('images', ['disk' => 'public']));
        }*/
        foreach ($request->images as $path) {
            $image = new Image;
            $image->news_id = $id;
            $image->url = $path;
            $image->save();
        }

        $oldTags = NewsTag::where('news_id',$id)->get();
        foreach ($oldTags as $tag) {
            $tag->delete();
        }
        foreach ($request->tags as $tag_id) {
            $newTag = NewsTag::create([
                'news_id' => $id,
                'tag_id' => $tag_id
            ]);
        }

        return "Updated Successfully";
    }

    function destroy($id) {
        $news = News::findOrFail($id);
        $news->delete();
        return "Deleted Successfully";
    }

    function userIndex() {
        $news = News::with('images')->with('tags')->with('user')->paginate(1);
        //dd($news);
        return view('users.index')->with('news', $news);
    }
}
