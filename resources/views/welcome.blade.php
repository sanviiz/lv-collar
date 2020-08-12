<!DOCTYPE html>
<html lang="en">

<head>
    <title>Collar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/collar.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js'></script>
</head>

<body>
    <div id="app">
        <div class="collar-background"></div>
        <collar-wait></collar-wait>
    </div>

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>