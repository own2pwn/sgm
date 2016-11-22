@extends('layouts.app')

@section('content')
{{-- Product --}}
<div class="container-fluid no-left-right-padding">
    <div class="row">
        <div class="col-md-6 bg-black no-padding">
            <a href="{{ url('products/b/babyhood') }}"><img src="{{ asset('img/'.$babyhood_img) }}" class="img-responsive" alt="{{ $babyhood_text }}"></a>
        </div>
        <div class="col-md-6 bg-blue no-padding">
            <a href="{{ url('products/b/nuna') }}"><img src="{{ asset('img/'.$nuna_img) }}" class="img-responsive" alt="{{ $nuna_text }}"></a>
        </div>
    </div>
</div>

{{-- About --}}
<div id="about" class="container top-bottom-margin-md">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>{!! $about_text !!}</p>
        </div>
    </div>
</div>

{{-- Feature --}}
<div class="container-fluid top-bottom-margin-md no-left-right-padding">
    <div id="feature" class="row bottom-margin-lg bg-black highlight">
        <div class="col-md-6 padding-md">
            <h1 class="text-center">{{ $tagline_title }}</h1>
            <p class="text-center">{!! $tagline_text !!}</p>
        </div>
        <div class="col-md-6 no-left-right-padding">
            <img src="{{ asset('img/'.$tagline_img) }}" class="img-responsive center-block">
        </div>
    </div>
    <div id="event" class="row bottom-margin-lg highlight">
        <div class="col-md-6 no-left-right-padding">
            <img src="{{ asset('img/'.$event_img) }}" class="img-responsive center-block">
        </div>
        <div class="col-md-6 padding-md">
            <h1 class="text-center">{{ $event_title }}</h1>
            <p class="text-center">{!! $event_text !!}</p>
        </div>
    </div>
    <div id="potm" class="row bg-black highlight">
        <div class="col-md-6 padding-md">
            <h1 class="text-center">{{ $potm_title }}</h1>
            <p class="text-center">{!! $potm_text !!}</p>
        </div>
        <div class="col-md-6 no-left-right-padding">
            <img src="{{ asset('img/'.$potm_img) }}" class="img-responsive center-block">
        </div>
    </div>
</div>

{{-- Article --}}
{{-- <div class="container-fluid top-bottom-margin-md">
    <div class="row">
        <div class="col-md-3">
            <h2>Article Title 1</h2>
            <p>Both you and your baby benefit from breastfeeding but it can be hard work. Here you'll learn how to breastfeed your baby and get expert breastfeeding tips. You'll also learn about breast milk, breast pumping, and when it's time to start weaning</p>
        </div>
        <div class="col-md-3">
            <h2>Article Title 2</h2>
            <p>Whether you have children or are expecting a little one, it’s important to make sure everyone buckles up every time.</p>
        </div>
        <div class="col-md-3">
            <h2>Article Very Very Very Very Long Title 1</h2>
            <p>Leaving kids alone in cars is not only illegal in many States, but on a warm day it’s downright lethal—so lethal that 636 children died in hot cars between 1998 and 2014. Learn why habitually checking all the seats in your car before locking the door can save a child’s life.</p>
        </div>
        <div class="col-md-3">
            <h2>Article Title 3</h2>
            <p>There are many car seat and booster seat choices on the market. Use this information to help you choose the right seat for your child’s age and size.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center top-margin-md">
                <a href="" >Read More Articles</a>
            </div>
        </div>
    </div>
</div> --}}

{{-- Contact --}}
<div id="getintouch" class="container top-bottom-margin-md">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center">
                @if ($message = session('message'))
                    <div class="alert alert-info" role="alert">{{ $message }}</div>     
                    {{ session()->flush() }}
                @endif
                <h1 class="bottom-padding-sm">Get In Touch!</h1>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/contact') }}">
                    {{ csrf_field() }}kk
                    <div class="form-group{{ $errors->has('contact_name') || $errors->has('contact_email') ? ' has-error' : '' }}">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contact_name" required value="{{ old('contact_name') }}" placeholder="Name" />
                            @if ($errors->has('contact_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contact_email" required value="{{ old('contact_email') }}" placeholder="Email" />
                            @if ($errors->has('contact_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('contact_message') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <textarea class="form-control" name="contact_message" required rows="5">{{ old('contact_message') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-default">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Social Media --}}
<div id="followus" class="container-fluid padding-md bg-grey">
    <div class="row">
        <div class="col-md-3">
            <div class="text-center">
                <a href="{{ $facebook_babyhood_url }}" target="_blank"><i class="icon-social-facebook icon-md icon-border-rd bg-blue"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <a href="{{ $instagram_babyhood_url }}" target="_blank"><i class="icon-social-instagram icon-md icon-border-rd bg-blue"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <a href="{{ $facebook_nuna_url }}" target="_blank"><i class="icon-social-facebook icon-md icon-border-rd bg-black"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <a href="{{ $instagram_nuna_url }}" target="_blank"><i class="icon-social-instagram icon-md icon-border-rd bg-black"></i></a>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="container-fluid no-left-right-padding">
    <div class="row">
        <div class="col-md-12">
            <div id="footer" class="text-center">
                <p>Copyright Supreme Global Marketing</p>
            </div>
        </div>
    </div>
</div>
@endsection
