<?php

namespace App\Http\Controllers;

use App\Models\subscribers;
use Illuminate\Http\Request;

class subscriberController extends Controller
{
    public function subscribersPage(){
        $subscribers = subscribers::all();
        return view('subscribers',['subscribers'=>$subscribers]);
    }
    public function addSubscriberPage(){
        return view('addSubscriber');
    }
    public function addSubscriber(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:subscribers',
            'birth_day' => 'required',
        ]);
        $new_subscribers = new subscribers();
        $new_subscribers->first_name = $request->first_name;
        $new_subscribers->last_name = $request->last_name;
        $new_subscribers->email = $request->email;
        $new_subscribers->birth_day = $request->birth_day;
        $new_subscribers->save();
        return redirect('subscriber/add')->with('message','Subscriber Add successfully');
    }
}
