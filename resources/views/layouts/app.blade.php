@extends('layouts.base')

@section('body')

<!-- Navigation  -->
@include('includes.nav')
<!-- Site Wrapper -->
<div class="site_wrapper">

    @yield('content')

</div>

@yield('footer')

@stop