<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\FormRequest;
use App\Models\Prop\Archived;

use Auth;

class UsersController extends Controller
{
    public function allRequests(){

        if(auth()->user()){
        $allRequests = FormRequest::where('user_id', Auth::user()->id)->get();

        //access new page in users folder
        return view('users.displayrequests', compact('allRequests'));
        }
        else{
            return abort('404');
        }
    }

    public function allSavedProps(){
        if(auth()->user()){
        $allSavedProps = Archived::where('user_id', Auth::user()->id)->get();

        //access new page in users folder
        return view('users.displaysavedprops', compact('allSavedProps'));
    }
    else{
        return abort('404');
    }
}

}
