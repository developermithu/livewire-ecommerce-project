<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{asset('backend/assets/img/sidebar-1.jpg')}}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->
<div class="logo">
{{-- <a href="{{route('admin.dashboard')}}" class="simple-text logo-mini">
DM
</a> --}}
<a href="{{route('admin.dashboard')}}" class="simple-text text-center logo-normal">
Dashboard
</a>
</div>
<div class="sidebar-wrapper">
<div class="user">
<div class="photo">
<img src="{{asset('backend/assets/img/faces/avatar.jpg')}}" />
</div>
<div class="user-info">
<a data-toggle="collapse" href="#collapseExample" class="username">
    <span>
        Tania Andrew
        <b class="caret"></b>
    </span>
</a>
<div class="collapse" id="collapseExample">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal"> My Profile </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal"> Edit Profile </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="sidebar-mini"> S </span>
                <span class="sidebar-normal"> Settings </span>
            </a>
        </li>
    </ul>
</div>
</div>
</div>
<ul class="nav">
    
<li class="nav-item {{request()->is('admin/dashboard') ? 'active' : ""}} ">
<a class="nav-link" href="{{route('admin.dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
</a>
</li>

<li class="nav-item {{request()->is('admin/category') ? 'active' : ""}} ">
    <a class="nav-link" href="{{route('admin.category')}}">
        <i class="material-icons">list</i>
        <p>Category</p>
    </a>
</li>

<li class="nav-item {{Route::is('admin.products*') ? 'active' : ""}} ">
    <a class="nav-link" href="{{route('admin.products')}}">
        <i class="material-icons">local_mall</i>
        <p>Product</p>
    </a>
</li>

<li class="nav-item {{Route::is('admin.sale-timer*') ? 'active' : ""}} ">
    <a class="nav-link" href="{{route('admin.sale-timer')}}">
        <i class="material-icons">local_mall</i>
        <p>Sale Timer</p>
    </a>
</li>

<li class="nav-item {{Route::is('admin.coupons*') ? 'active' : ""}} ">
    <a class="nav-link" href="{{route('admin.coupons')}}">
        <i class="material-icons">local_mall</i>
        <p>Coupons</p>
    </a>
</li>

{{-- 
<li class="nav-item {{request()->is('admin/appointments*') ? 'active' : ""}} ">
    <a class="nav-link" href="{{route('admin.appointments')}}">
        <i class="material-icons">calendar_view_month</i>
        <p>Appointment</p>
    </a>
    </li> --}}

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#pagesExamples">
    <i class="material-icons">image</i>
    <p>
        Pages
        <b class="caret"></b>
    </p>
</a>
<div class="collapse" id="pagesExamples">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="pages/login.html">
                <span class="sidebar-mini"> LP </span>
                <span class="sidebar-normal"> Login Page </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/register.html">
                <span class="sidebar-mini"> RP </span>
                <span class="sidebar-normal"> Register Page </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/user.html">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal"> User Profile </span>
            </a>
        </li>
    </ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" href="post.html">
    <i class="material-icons">date_range</i>
    <p>Post</p>
</a>
</li>

</ul>
</div>
<div class="sidebar-background" style="background-image: url({{asset('frontend/assets/img/sidebar-1.jpg')}})">
</div>
</div>