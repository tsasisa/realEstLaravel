<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Prop\HomeType;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\FormRequest;
use App\Models\Prop\PropImage;
use File;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin()
    {

        return view('admins.login');

    }

    public function checkLogin(Request $request)
    {


        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);


    }

    public function index()
    {

        $adminsCount = Admin::select()->count();
        $propsCount = Property::select()->count();
        $modelsCount = HomeType::select()->count();

        return view('admins.index', compact('adminsCount', 'propsCount', 'modelsCount'));

    }

    public function allAdmins()
    {

        $allAdmins = Admin::select()->get();

        return view('admins.admins', compact('allAdmins'));

    }

    public function createAdmins()
    {

        return view('admins.createadmins');

    }

    public function saveAdmins(Request $request)
    {

        Request()->validate([
            "name" => "required|max:30",
            "email" => "required|max:30",
            "password" => "required|max:30",
        ]);

        $saveAdmins = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->name),


        ]);

        if ($saveAdmins) {

            return redirect('/admin/all-admins/')->with('success', 'Admin successfully added!');

        }
    }

    public function allHomeTypes()
    {

        $allHomeTypes = HomeType::select()->get();

        return view('admins.hometypes', compact('allHomeTypes'));

    }

    public function createHomeTypes()
    {



        return view('admins.createhometypes');

    }



    public function saveHomeTypes(Request $request)
    {

        Request()->validate([
            "hometypes" => "required|max:100"
        ]);

        $saveHomeTypes = HomeType::create([
            'hometypes' => $request->hometypes,

        ]);

        if ($saveHomeTypes) {

            return redirect('/admin/all-hometypes/')->with('create', 'Hometype successfully created!');

        }
    }

    public function updateHomeTypes($id)
    {

        $homeType = HomeType::find($id);

        return view('admins.updatehometypes', compact('homeType'));

    }

    public function updatedHomeTypes(Request $request, $id)
    {

        Request()->validate([
            "hometypes" => "required|max:20"
        ]);

        $singleHomeType = HomeType::find($id);
        $singleHomeType->update($request->all());

        if ($singleHomeType) {
            return redirect('/admin/all-hometypes/')->with('success', 'Home Type Successfully updated!');
        }
    }


    public function deleteHomeTypes($id)
    {
        $homeType = HomeType::find($id);
        $homeType->delete();

        if ($homeType) {
            return redirect('/admin/all-hometypes/')->with('delete', 'Home Type Successfully deleted!');
        }

    }

    public function Requests()
    {

        $requests = FormRequest::all();

        return view('admins.requests', compact('requests'));

    }

    public function allProps()
    {

        $props = Property::all();

        return view('admins.props', compact('props'));

    }

    public function createProps()
    {
        $homeTypes = HomeType::all();

        return view('admins.createprops');

    }

    public function saveProps(Request $request)
    {
        Request()->validate([
            "title" => "required|max:50",
            "price" => "required|max:30",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            "beds" => "required|max:30",
            "baths" => "required|max:30",
            "sq_ft" => "required|max:30",
            "year_built" => "required|max:30",
            "price_sqft" => "required|max:30",
            "location" => "required|max:30",
            "home_type" => "required|max:30",
            "type" => "required|max:30",
            "city" => "required|max:30",
            "more_info" => "required|max:30",
            "agent_name" => "required|max:30",
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $saveProps = Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $myimage,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'sq_ft' => $request->sq_ft,
            'year_built' => $request->year_built,
            'price_sqft' => $request->price_sqft,
            'location' => $request->location,
            'home_type' => $request->home_type,
            'type' => $request->type,
            'city' => $request->city,
            'more_info' => $request->more_info,
            'agent_name' => $request->agent_name,

        ]);

        if ($saveProps) {

            return redirect('/admin/all-props/')->with('success', 'Property successfully added!');

        }
    }

    public function createGallery()
    {
        $showprops = Property::all();

        return view('admins.creategallery', compact('showprops'));

    }

    public function saveGallery(Request $request)
    {
        Request()->validate([
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'prop_id' => 'required|max:100',
        ]);

        $files = [];
        // hasfile -> name of the name in input part in creategallery page
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $path = 'assets/images_gallery/';
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path($path), $name);
                $files[] = $name;

                PropImage::create([
                    "image" => $name,
                    "prop_id" => $request->prop_id,
                ]);
            }
        }


        if ($name) {

            return redirect('/admin/all-props/')->with('success_gallery', 'Gallery successfully added!');

        }

    }

    public function deleteProps($id)
    {
        $deleteProp = Property::find($id);

        if (File::exists(public_path('assets/images/' . $deleteProp->image))) {
            File::delete(public_path('assets/images/' . $deleteProp->image));
        }

        $deleteProp->delete();

        // gallery delete part based on deleted propertry's id
        $deleteGallery = PropImage::where("prop_id", $id)->get();

        foreach ($deleteGallery as $delete) {
            if (File::exists(public_path('assets/images/' . $delete->image))) {
                File::delete(public_path('assets/images/' . $delete->image));
            }

            $delete->delete();
        }


        return redirect('/admin/all-props/')->with('success_delete', 'Property successfully deleted!');

    }


}
