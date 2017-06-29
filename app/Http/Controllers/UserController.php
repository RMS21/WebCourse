<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use App\News;
use App\Category;
use App\Like;
use App\Comment;
use App\Tag;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('public.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required | alpha_spaces',
            'password' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/' ]
        ]);



        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->JSON([ 'fail' => 'نام کاربری یا رمزعبور اشتباه است' ]);
        }
        return response()->JSON([ 'url' => "http://localhost:8000/" ]);
    }

    public function getRegister()
    {
        return view('public.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required | alpha_spaces',
            'lname' => 'required | alpha_spaces',
            'username' => 'required | alpha_spaces',
            'password' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/', 'confirmed'],
            'password_confirmation' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/'],
            'email' => 'required | email'
        ]);

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->role = "member";
        $user->save();

        Auth::login($user);

        return response()->JSON([ 'url' => 'http://localhost:8000/' ]);
    }

    public function getHome($param=null)
    {
        if ($param != null) {
            if (Category::where('name', '=', $param)->exists()) {
                $category = $param;
                $newses = DB::table('news')->join('categories', 'news.category_id', '=', 'categories.id')->select('news.*')->where('categories.name', '=', $category)->paginate(5);
            } elseif (Tag::where('name', '=', $param)->exists()) {
                $category = null;
                $newses = DB::table('news_tags')->join('tags', 'tags.id', '=', 'news_tags.tag_id')->join('news', 'news.id', '=', 'news_tags.news_id')->select('news.*')->where('tags.name', 'LIKE', '%'. $param .'%')->distinct('news.*')->paginate(5);
            } elseif (News::where('user_username', '=', $param)->exists()) {
                $category = null;
                $newses = News::where('user_username', 'LIKE', '%'. $param . '%')->paginate(5);
            } elseif(News::where('title', 'LIKE', '%'. $param . '%')->exists()){
                $category = null;
                $newses = News::where('title', 'LIKE', '%'. $param . '%')->paginate(5);
            } elseif(News::where('description', 'LIKE', '%'. $param . '%')->exists()){
                $category = null;
                $newses = News::where('description', 'LIKE', '%'. $param . '%')->paginate(5);
            }else if(Comment::where('text', "LIKE", '%'. $param .'%')->exists()){
                $category = null;
                $newses = DB::table('news')->join('comments', 'comments.news_id', 'news.id')->where('comments.text', 'LIKE', '%' . $param . '%')->distinct()->select('news.*')->paginate(5);
            }
            else{
                $category = null;
                $newses = null;
            }
        } else {
            $newses = News::orderBy('created_at', 'desc')->paginate(5);
            $category = null;
        }
        $categories = Category::all();

        return view('public.home', [ 'user' => Auth::user(), "newses" => $newses, 'categories' => $categories, 'category' => $category ]);
    }

    public function getLikeNews($news_id)
    {
        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->news_id = $news_id;
        $like->save();
        return redirect()->back();
    }

    public function postCommentNews(Request $request)
    {
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->save();
        return redirect()->back();
    }

    public function postSearchTag(Request $request)
    {
        return redirect()->route('get_home', [ 'param' => $request->text ]);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('get_login');
    }
}
