<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index(){
        //Remove the parameters in the function and use dd(request('tag'));
        // dd($request['tag']);
        return view('listings.index', [
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(5)
        ]);
    }

    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show Create Form
    public function create(){
        return view('listings.create');
    }

    //Store Listing
    public function store(Request $request){
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // if ($request->hasFile('logo')) {
        //     $logoPath = $request->file('logo')->store('logos', 'public');
        //     $data['logo'] = $logoPath;
        // }

        if($request->hasFile('logo')){
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($data);
        return redirect('/')->with('message', 'Listing Created!');
    }

    //Edit Listing
    public function edit(Listing $listing){
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    //Update Listing
    public function update(Request $request, Listing $listing){
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($request->hasFile('logo')){
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($data);
        return redirect('/')->with('message', 'Listing Updated!');
    }
}
