<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactEmailJob;
use App\Jobs\SendSubscriptionEmailJob;
use App\Models\ContactUs;
use App\Models\Page;
use App\Models\Service;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view('welcome');
    }


    public function contact(Request $request)
    {
        $data = [
            'title' => 'Contact Us',
        ];
        return view('contact',$data);
    }
    

    public function contactUs(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $contactMessage  = new ContactUs;
        $contactMessage->name = $request->name;
        $contactMessage->email = $request->email;
        $contactMessage->subject = $request->subject;
        $contactMessage->message = $request->message;

        if ($contactMessage->save()) {

            dispatch(new SendContactEmailJob($contactMessage));

            return response()->json(['status'=>'success','message'=>('Message sent successfully')]);
        }else{
            return response()->json(['status'=>'error','message'=>('error could not send contact message')]);
        }

    }


    public function subscribe(Request $request) {
        $request->validate([
            'email' => 'required',
        ]);

        try {

            $subscribe  = new Subscribe;
            if (!$subscribe->where('email',$request->email)->first()) {
                $subscribe->email = $request->email;
                $subscribe->save();

                dispatch(new SendSubscriptionEmailJob($request->email));
            }
            dispatch(new SendSubscriptionEmailJob($request->email));
            return response()->json(['status'=>'success','message'=>('Thank you for subscribing with us 😊 🎉')]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>'error','message'=>('error could not send contact message')]);
        }

    }

    

    public function dynamicPage(Request $request, mixed $slug)
    {
        $url = get_segmented_url($request->segments());
        //  search pages
        if ($page = Page::where('url', $url)->first()) {
            $content = $page->content;
            $title = $page->name;

            if (!empty($page->view)) {
                // return view with contents
                return view('pages.' . $page->view, compact('content', 'title'));
            } else {
                // return Dynamic Page with contents
                return view('page', compact('content', 'title'));
            }
        }
    }



}
