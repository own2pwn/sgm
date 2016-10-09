<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;

class HomeController extends Controller
{

    /**
     * The Home instance.
     * @var App\Home
     */
    protected $home;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Home $home)
    {
        $this->middleware('auth');

        $this->home = $home;

        if (is_null($this->home->first()))
        {
            $this->home->about_text = 'New about lah';
            $this->home->save();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', $this->getData());
    }

    /**
     * Display edit home page.
     * 
     */
    protected function edit()
    {
        return view('home.edit', $this->getData());
    }

    /**
     * Updates home page data.
     *
     * @return void
     */
    protected function update(Request $request)
    {
        $home = $this->home->first();

        $home->nuna_text = $request['nuna_text'];
        $home->nuna_img = $this->imageUpload($request, 'nuna_img', $home->nuna_img);
        $home->babyhood_text = $request['babyhood_text'];
        $home->about_text = $request['about_text'];
        $home->babyhood_img = $this->imageUpload($request, 'babyhood_img', $home->babyhood_img);
        $home->tagline_title = $request['tagline_title'];
        $home->tagline_text = $request['tagline_text'];
        $home->tagline_img = $this->imageUpload($request, 'tagline_img', $home->tagline_img);
        $home->event_title = $request['event_title'];
        $home->event_text = $request['event_text'];
        $home->event_img = $this->imageUpload($request, 'event_img', $home->event_img);
        $home->potm_title = $request['potm_title'];
        $home->potm_text = $request['potm_text'];
        $home->potm_img = $this->imageUpload($request, 'potm_img', $home->potm_img);
        $home->facebook_url = $request['facebook_url'];
        $home->twitter_url = $request['twitter_url'];
        $home->instagram_url = $request['instagram_url'];
        $home->contact_email = $request['contact_email'];

        $home->save();

        return back()->with('success','Update successful.');
    }

    /**
     * Manage Post Request
     *
     * @return void
     */
    public function imageUpload(Request $request, $field_name, $old_value)
    {
        $imageName = $old_value;

        if ($request->hasFile($field_name))
        {
            $this->validate($request, [
                $field_name => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file($field_name);
            // $imageName = $field_name.'-'.time().'.'.$image->getClientOriginalExtension();
            $imageName = $field_name.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        }

        return $imageName;
    }

    /**
     * Process contact inquiry.
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function contact(Request $request) {

    }

    /**
     * Get data for home views.
     * 
     * @return an array of Home attributes' value
     */
    private function getData()
    {
        $data = $this->home->first()->toArray();
        return $data;
    }
}
