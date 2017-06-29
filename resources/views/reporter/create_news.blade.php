
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>پورتفوی</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ URL::to('assets/bootstrap-rtl/css/bootstrap.rtl.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/Material-Kit/assets/css/material-kit.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/webui-popover-master/src/jquery.webui-popover.css') }}">

  <link rel="stylesheet" href="{{ URL::to('assets/Materialze-tg/css/materialize-tags.css') }}">

  <link rel="stylesheet" href="{{ URL::to('assets/css/create_news.css') }}">
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
              <a class="navbar-brand" href="{{ route('get_home') }}">
                    <img src="{{ URL::to('assets/img/logo.png') }}">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left">
              <li class="my-active">
                <a href="{{ route('get_logout') }}">
                                         خروج
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-offset-3 col-lg-6 user-interact">
      <h3>طرح خبر</h3>
      <form enctype="multipart/form-data" action="{{ route('post_create_news') }}" method="POST">
          <p style="color: #f44268;display:none;" id="error">ورودی های خود را کنترل کنید</p>
        <div class="form-group label-floating title">
          <label class="control-label">عنوان خبر</label>
          <input type="text" class="form-control" tabindex="1" name="title"required>
        </div>
        <div class="content">
          <div id="textareaTags">
            <div class="form-group label-floating">
              <label class="control-label"> متن خبر ...</label>
              <textarea class="form-control" rows="12" tabindex="2" name="description" required></textarea>
            </div>
          </div>
        </div>
        <div class="form-group label-floating tags">
          <label class="control-label" id="label">برچسبها</label>
          <input type="text" class="form-control" data-role="materialtags" tabindex="3" name="tags">
        </div>
        <select placeholder="انتخاب مرحله" id="game-stage" name="category">
            <option value="انتخاب گروه" selected="selected" class="selected">انتخاب گروه</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <div id="file-uploader">
          <div class="form-group form-file-upload">
            <input type="file" id="inputFile2" name="image">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="سوال تصویری" >
              <span class="input-group-btn input-group-s">
                    <button type="button" class="btn btn-just-icon btn-round btn-primary" style="border-radius:30px;">
                        <i class="material-icons">attach_file</i>
                    </button>
              </span>
            </div>
          </div>
        </div>
        <div class="form-group mysubmit">
          <input type="submit" class="form-control btn-success" name="submit" value="ارسال">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="{{ route('get_home') }}" id="btn-danger">انصراف</a>
        </div>
      </form>
    </div>
  </div>
    <script src="{{ URL::to('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/webui-popover-master/src/jquery.webui-popover.js') }}"></script>
    <script src="{{ URL::to('assets/Materialze-tg/js/materialize-tags.js') }}"></script>
    <script src="{{ URL::to('assets/Materialze-tg/js/typehead.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/material.min.js') }}"></script>
    <script src="{{ URL::to('assets/Material-Kit/assets/js/material-kit.js') }}"></script>
    <script src="{{ URL::to('assets/js/create_news.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(".select").dropdown({ "autoinit" : ".select" });
            $(".select").dropdown({ "dropdownClass": "my-dropdown", "optionClass": "my-option awesome" });
        })
    </script>
</body>
</html>
