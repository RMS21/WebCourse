<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\News;
use App\Tag;
use App\NewsTag;
use App\Category;
use Illuminate\Support\Facades\DB;

class ReporterController extends Controller
{
    public function getCreateNews()
    {
        $categories = Category::all();
        return view('reporter.create_news', [ 'categories' => $categories ]);
    }

    public function postCreateNews(Request $request)
    {

        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        if (!is_null($request->image)) {
            $image = $request->image;
            $last_news_id = DB::table('news')->max('id');
            if(!isset($last_news_id)){
                $last_news_id = 0;
            }
            $last_news_id += 1;
            $dir = 'uploads/img/news/' . $request->category . '/';
            $image_name = $last_news_id .'.'. $image->getClientOriginalExtension();
            $request->image->move($dir, $image_name);
            $image_path = $dir.''. $image_name;
        } else {
            $image_path = "";
        }
        $news->image_path = $image_path;
        $news->category_id = Category::where('name', '=', $request->category)->first()->id;
        $news->user_username = Auth::user()->username;
        $news->save();

        $tags = explode(",", $request->tags);
        foreach ($tags as $tag) {
            $tmp = Tag::where('name', '=', $tag)->first();
            if ($tmp == null) {
                $newTag = new Tag();
                $newTag->name = $tag;
                $newTag->save();
                $news_tag = new NewsTag();
                $news_tag->news_id = $news->id;
                $news_tag->tag_id = $newTag->id;
                $news_tag->save();
            } else {
                $news_tag = new NewsTag();
                $news_tag->news_id = $news->id;
                $news_tag->tag_id = $tmp->id;
                $news_tag->save();
            }
        }

        return redirect()->route('get_home');
    }
}
