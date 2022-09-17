<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // i well remove get() and use paginate(), because i want to work with pages 1, 2, 3
        // return view("gigs.index", [
        //     "gigs" => Gig::latest()->filter(request(["tag", "search"]))->get()
        // ]);

        return view("gigs.index", [
            "gigs" => Gig::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("gigs/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     "company" => ["required", Rule::unique('gigs', 'company')],
        //     "title" => "required",
        //     "location" => "required",
        //     "email" => ["required", "email", Rule::unique('gigs', 'email')],
        //     "website" => "required",
        //     "tags" => "required",
            // "logo" => "required",
        //     "description" => "required",
        // ]);

        // $gig = new Gig();

        // $gig->company = strip_tags($request->input('company'));
        // $gig->title = strip_tags($request->input('title'));
        // $gig->location = strip_tags($request->input('location'));
        // $gig->email = strip_tags($request->input('email'));
        // $gig->website = strip_tags($request->input('website'));
        // $gig->tags = strip_tags($request->input('tags'));
        // $gig->logo = strip_tags($request->input('logo'));
        // $gig->description = strip_tags($request->input('description'));

        // $gig->save();
        
        // return redirect()->route("gigs.index");

        // if we use this way we should declare fillable properties in model Gig

        $formField = $request->validate([
            "company" => ["required", Rule::unique('gigs', 'company')],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email", Rule::unique('gigs', 'email')],
            "website" => "required",
            "tags" => "required",
            "description" => "required",
        ]);

        if($request->hasFile("logo")){
            $formField["logo"] = $request->file("logo")->store("logos", "public");
        }

        Gig::create($formField);

        return redirect("/")->with('success_message', 'Gig is created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gig $gig)
    {
        return view("gigs.show", ["gig" => $gig]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
