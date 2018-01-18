<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acme Store - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/css/all.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body data-page-id="@yield('data-page-id')">
    
    @yield('body')


<script async src="/js/all.js"></script>
</body>
</html>

