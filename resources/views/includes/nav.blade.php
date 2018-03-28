<?php $categories = \App\Models\Category::with('subCategories')->get(); ?>
<header class="navigation">
    <div class="hide-for-medium">
        <div class="title-bar toggle" data-responsive-toggle="main-menu" data-hide-for="medium">
            <button class="menu-icon float-right" type="button" data-toggle="main-menu"></button>
            <a href="/" class="float-left small-logo">ACME Store</a>
        </div>
    
        <div class="top-bar" id="main-menu">
            <div class="menu medium-horizontal expanded medium-text-center" data-dropdown-menu
                 data-responsive-menu="drilldown medium-dropdown" data-click-open="true"
                 data-disable-hover="true" data-close-on-click-inside="false">
            
                <div class="top-bar-title show-for-medium">
                    <a href="/" class="logo"></a>
                </div>
            
                <div class="top-bar-left">
                    <ul class="dropdown menu vertical medium-horizontal">
                        <li><a href="#">Acme Products</a> </li>
                        @if(count($categories))
                            <li>
                                <a href="#">Categories</a>
                                <ul class="menu vertical sub dropdown">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="#">{{ $category->name }}</a>
                                            @if(count($category->subCategories))
                                                <ul class="menu sub vertical">
                                                    @foreach($category->subCategories as $subCategory)
                                                        <li>
                                                            <a href="#">
                                                                {{ $subCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="dropdown menu vertical medium-horizontal">
                        <li><a href="#">Username</a> </li>
                        <li><a href="/login">Sign In</a> </li>
                        <li><a href="/register">Register</a> </li>
                        <li><a href="/cart">Cart</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="show-for-medium">
        <div class="top-bar" id="main-menu">
            <div class="menu medium-horizontal expanded medium-text-center" data-dropdown-menu
                 data-responsive-menu="drilldown medium-dropdown" data-click-open="true"
                 data-disable-hover="true" data-close-on-click-inside="false">
            
                <div class="top-bar-title show-for-medium">
                    <a href="/" class="logo"></a>
                </div>
            
                <div class="top-bar-left">
                    <ul class="dropdown menu vertical medium-horizontal">
                        <li>Acme Products</li>
                        @if(count($categories))
                            <li>
                                <a href="#">Categories</a>
                                <ul class="menu vertical sub dropdown">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="#">{{ $category->name }}</a>
                                            @if(count($category->subCategories))
                                                <ul class="menu sub vertical">
                                                    @foreach($category->subCategories as $subCategory)
                                                        <li>
                                                            <a href="#">
                                                                {{ $subCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="dropdown menu vertical medium-horizontal">
                        @if(isAuthenticated())
                            <li>{{ user()->username }}</li>
                            <li><a href="/cart">Cart</a> </li>
                            <li><a href="/logout">Logout</a> </li>
                        @else
                            <li><a href="/login">Sign In</a> </li>
                            <li><a href="/register">Register</a> </li>
                            <li><a href="/cart">Cart</a> </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
