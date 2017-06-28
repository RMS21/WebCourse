<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;

class AdminController extends Controller
{
  public function getDeleteNews($news_id){
      $news = News::find($news_id);
      $news->delete();
      return redirect()->back();
  }
}
