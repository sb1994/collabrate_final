<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>test</title>
     <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
     <link href="{{asset('css/comment.css')}}" rel="stylesheet" type="text/css">
      <meta name="csrf-token" id="token" value="{{ csrf_token() }}">
  </head>
  <body>
    <div id="app"></div>

    <script src="{{asset('js/app.js')}}"></script>
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
  </body>
</html>
