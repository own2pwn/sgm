@extends('layouts.base')

@section('css')
<link href="/css/style.css" rel="stylesheet">
@endsection

@section('navbar-right')
@if (Auth::guest())
    <li><a href="{{ url('/login') }}">Login</a></li>
    <li><a href="{{ url('/register') }}">Register</a></li>
@else
    <li><a href="#feature">Feature</a></li>
    <li><a href="#event">Event</a></li>
    <li><a href="#potm">Product of The Month</a></li>
    <li><a href="#getintouch">Get In Touch</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ url('/home/edit') }}">Edit Home</a>
                <a href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
@endif
@endsection
