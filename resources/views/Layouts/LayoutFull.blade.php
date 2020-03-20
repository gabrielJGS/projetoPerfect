<!DOCTYPE html>
<!-- saved from url=(0051)https://getbootstrap.com/docs/4.4/examples/pricing/ -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Sistema de Venda - @yield('title')</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/pricing/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('/img/brand/favicon.ico') }}">
  <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">
  <script src="https://kit.fontawesome.com/125c21ecbc.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  @stack('css')
</head>

<body>
  @include('Layouts.Menu')

  <div class="container">
    @yield('conteudo')

   @include('Layouts.Footer')
  </div>
</body>
@stack('scripts')
</html>