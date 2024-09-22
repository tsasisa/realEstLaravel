<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\FormRequest;
use App\Models\Prop\PropImage;
use App\Models\Prop\Archived;
use Auth;

// ini buat controller
class PropertiesController extends Controller
{
    public function index(){

    $props = Property::select()->take(9)->orderBy('id','DESC')->get();
    
    return view('home', compact('props'));

    }

    public function single($id){

        $singleprop = Property::find($id);

        $propImages = PropImage::where('prop_id', $id)->get();

        //relateed props ambil 3 buah yang home typenya sama selain dia sendiri
        //berdasarkan newest (create_at desc)
        $relatedProps = Property::where('home_type', '$singleprop->home_type')->where('id','!=',$id)->take(3)->orderBy('create_at','desc')->get();
        
        //validating form if requester is more than once (same person but requesting more than once on same property)
        if(auth()->user()){

        $validateFormCount = FormRequest::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();

        // validating archiving props
        $validateArchiveCount = Archived::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();

        return view('props.single', compact('singleprop', 'propImages', 'relatedProps', 'validateFormCount', 'validateArchiveCount'));
    
        } else{
            return view('props.single', compact('singleprop', 'propImages', 'relatedProps'));
        }
        
        }

        public function insertRequests(Request $request){

            // validate max characters for each column
            Request()->validate([
                "name" => "required|max:50",
                "email" => "required|max:50",
                "phone" => "required|max:30"
            ]);

            $insertRequest = FormRequest::create([
                "prop_id" => $request->prop_id,
                "agent_name" => $request->agent_name,
                "user_id" => Auth::user()->id,
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone
            ]);

            if($insertRequest){
                return redirect('/props/prop-details/'.$request->prop_id.'')->with('success','Request successfully sent!');
            }

            //echo "Request is successfully sent!";
        
            }

            public function archive(Request $request){
    
                $archivE = Archived::create([
                    "prop_id" => $request->prop_id,
                    "user_id" => Auth::user()->id,
                    "title" => $request->title,
                    "image" => $request->image,
                    "location" => $request->location,
                    "price" => $request->price
                ]);
    
                if($archivE){
                    return redirect('/props/prop-details/'.$request->prop_id.'')->with('save','Property archived!');
                }
    
            
                }

    
                public function propsBuy(){

                    $type = "Buy";

                    $propsBuy = Property::select()->where('type', $type)->get();
                    
                    return view('props.propsbuy', compact('propsBuy'));
                
                    }

                
                public function propsRent(){

                        $type = "Rent";
    
                        $propsRent = Property::select()->where('type', $type)->get();
                        
                        return view('props.propsrent', compact('propsRent'));
                    
                        }

        public function displayByHomeType($hometype){

                            
                    $propsByHomeType = Property::select()->where('home_type', $hometype)->get();
                            
                    return view('props.propshometype', compact('propsByHomeType', 'hometype'));
                        
        }
            
        public function priceAsc(){

                            
                $propsByPriceAsc = Property::select()->take(9)->orderBy('price', 'asc')->get();
                                
                return view('props.propspriceasc', compact('propsByPriceAsc'));
                            
        }

        public function priceDesc(){

                            
            $propsByPriceDesc = Property::select()->take(9)->orderBy('price', 'desc')->get();
                            
            return view('props.propspricedesc', compact('propsByPriceDesc'));
                        
    }
        
    // prop filter search

    public function searchProps(Request $request){

        //  get based on drop down list name that was set in home.blade.php
        $list_types = $request->get('list_types');     
        $offer_types = $request->get('offer_types'); 
        $select_city = $request->get('select_city'); 

        $searches = Property::select()->where('home_type', 'like', "%$list_types%")->where('type','like',"%$offer_types%")->where('city','like',"%$select_city%")->get();
                        
        return view('props.searches', compact('searches'));
                    
}
                        
}
