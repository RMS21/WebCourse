<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ isset($category) ? $category : "خانه"   }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ URL::to('assets/bootstrap-rtl/css/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/Material-Kit/assets/css/material-kit.css') }}">


        <link rel="stylesheet" href="{{ URL::to('assets/css/home.css') }}">

    </head>
    <body>
        <div class="container-fluid">
            <div id="navbar">
	            <div class="navigation-example">
                    <nav class="navbar">
						<div class="container">
							<div class="navbar-header navbar-right">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-info">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="home.html">
                                    <img src="{{ URL::to('assets/img/logo.png') }}">
                                </a>

							</div>


                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{ route('get_home') }}">خانه</a></li>
                                @if (isset($user) && ($user->role == "reporter"))
                                    <li>
                                        <a href="{{ route('get_create_news') }}" >
                                            طرح خبر
                                        </a>
                                    </li>
                                @endif
                                @if (isset($user) && ($user->role == "admin"))
                                    <li>
                                        <a href="{{ route('get_login') }}">
                                            مدیریت سایت
                                        </a>
                                    </li>
                                @endif
                                @if (!isset($user))
                                    <li>
                                        <a href="{{ route('get_login') }}">
                                            ورود
                                        </a>
                                    </li>
                                @endif

                                {{-- @if(isset($user))
                                    <li class="myactive">
                                        <a href="login.html">
                                            پروفایل
                                        </a>
                                    </li>
                                @endif --}}
                            </ul>
							<ul class="nav navbar-nav navbar-left">
                                @if (isset($user))
                                    <li>
                                        <a href="{{ route('get_logout') }}">
                                        خروج
                                    </a>
                                    </li>
                                @endif
                            </ul>
						</div>
					</nav>
	            </div>

            </div>

            <nav class="navbar navbar-rose">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right category">
                            @php
                                $flag = false;
                                if (isset($category)) {
                                    $flag = true;
                                }
                            @endphp
                            @foreach ($categories as $cat)
                                <li class="{{ ($cat->name == $category) ? 'myactive' : '' }}"><a href="{{ route('get_home', ['category' => $cat->name]) }}" >{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                        <form class="navbar-form navbar-left" role="search" method="post" action="{{ route('post_search_tag') }}">
                          <div class="form-group form-white">
                              <input type="text" class="form-control" placeholder="جستوجو با تگ..." name="text">
                          </div>
                          <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini"><i class="material-icons">search</i></button>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>

                    </div>
                </div>
            </nav>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @if ($newses->isEmpty())
                        <h3 style="text-center">خبری یافت نشد</h3>
                    @else
                        @foreach ($newses as $news)
                            <div class="panel panel-default bootcards-richtext">
                                <div class="panel-heading">
                                    @if (isset($user) && $user->role == "admin")
                                        <a href="{{ route('get_delete_news', ['news_id' => $news->id ])}}" class="pull-right"><i class="glyphicon glyphicon-remove-circle"></i></a>
                                    @endif
                                    <span class="pull-right">{{ $news->title }}</span>
                                    <span class="pull-left" style="margin-left: 10px;">نویسنده:‌ {{ $news->user_username }}</span>
                                    <p style="clear: both; "></p>
                                </div>
                                <div class="panel-body post-image">
                                    @if (!empty($news->image_path))
                                        <img src="{{ $news->image_path }}">
                                    @endif
                                    <p>
                                        {{ str_limit($news->description, 2000) }}
                                    </p>
                                    <div class="tags">
                                        @php
                                            $tags =  DB::table('news_tags')->join('news', 'news.id', '=', 'news_tags.news_id')->join('tags', 'tags.id', '=', 'news_tags.tag_id')->select('tags.*')->where('news_tags.news_id', '=', $news->id )->get();
                                        @endphp
                                        <em>
                                                برچسب ها:
                                            @foreach ( $tags as $tag)
                                                @if ($loop->last)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @else
                                                    <a href="#">{{ $tag->name }}</a>,
                                                @endif
                                            @endforeach
                                        </em>

                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="modal-liker-post-text">
                                        <span class="glyphicon glyphicon-heart"></span>
                                        @php
                                            $likes = DB::table('likes')->join('users', 'users.id', '=', 'likes.user_id')->join('news', 'news.id', '=', 'likes.news_id')->select('users.*')->where('likes.news_id', '=', $news->id)->get();
                                        @endphp
                                        <span>{{ count($likes) ? count($likes) : 0 }}</span>
                                    </div>
                                    <div class="comment-post-text">
                                        <span class="glyphicon glyphicon-comment"></span>
                                        @php
                                            $comments = DB::table('comments')->join('users', 'users.id', '=', 'comments.user_id')->join('news', 'news.id', '=', 'comments.news_id')->select('comments.text', 'users.username')->where('comments.news_id', '=', $news->id)->get();
                                        @endphp
                                        <span>{{ count($comments) ? count($comments) : 0 }}</span>
                                    </div>
                                    <ul class="post-comments">
                                        @if ($comments)
                                            @foreach ($comments as $comment)
                                                <li class="comment">
                                                    <span class="comment-body">{{ $comment->text }}</span>
                                                    <span class="comment-username">{{ $comment->username }}</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    @if (isset($user))
                                        <form action="{{ route('post_comment_news') }}" method="post">
                                            <div class="media media-post">
            		                              <div class="media-body">
            		                                    <textarea class="form-control" name="text" placeholder="کامنت بگذار..." rows="3"></textarea>
            		                                    <div class="media-footer">
            		                                         <button type="submit" href="#pablo" class="btn btn-primary btn-wd pull-right">ارسال کامنت</button>
            		                                    </div>
            		                              </div>
                                                  <a class="pull-left author" href="{{ route('get_like_news', [ 'news_id' => $news->id ])}}">
            		                                  <div class="avatar">
                                                        <span class="glyphicon glyphicon-heart heart"></span>
            		                                  </div>
            		                              </a>
            		                          </div>
                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                              <input type="hidden" name="news_id" value="{{ $news->id }}">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @include('../partial.pagination', ['paginator' => $newses])
            </div>
        </div>
    </body>
    <script src="{{ URL::to('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/material.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/dropdown.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/material-kit.js') }}"></script>
    <script src="{{ URL::to('assets/js/position.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.comment-post-text').click(function(){
                $('.post-comments').toggle(500);
            });
        });
    </script>
</html>
