<!DOCTYPE html>
<html lang="en">

<head>
  <title>Collar Qrscan</title>
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
    <collar-info>
      <textarea slot="1" placeholder="No Information." name="inputtokenkey" id="tokenkey" class="collar-form-control" rows="1" readonly>{{$info->tokenid}}</textarea>
      <textarea slot="2" placeholder="No Information." name="inputdogname" id="petname" class="collar-form-control" rows="1" readonly>{{$info->dogname}}</textarea>
      <textarea slot="3" placeholder="No Information." name="inputname" id="name" class="collar-form-control" rows="1" readonly>{{$info->name}}</textarea>
      <textarea slot="4" placeholder="No Information." name="inputaddress" id="address" class="collar-form-control-address" rows="1" readonly>{{$info->address}}</textarea>
      <textarea slot="5" placeholder="No Information." name="inputtel" id="tel" class="collar-form-control" rows="1" readonly>{{$info->tel}}</textarea>
      </collar-info>
  </div>
  <script>
    autosize(document.querySelectorAll('textarea'));
  </script>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>