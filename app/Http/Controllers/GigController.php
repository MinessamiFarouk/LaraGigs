<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GigController extends Controller
{
    public function index() {
        // i well remove get() and use paginate(), because i want to work with pages 1, 2, 3
        // return view("gigs.index", [
        //     "gigs" => Gig::latest()->filter(request(["tag", "search"]))->get()
        // ]);

        return view("gigs.index", [
            "gigs" => Gig::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }
    public function create()
    {
        return view("gigs.create");
    }

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

        $formField['user_id'] = auth()->id();

        Gig::create($formField);

        return redirect("/")->with('success_message', 'Gig is created successfuly');
    }

    public function show(Gig $gig)
    {
        return view("gigs.show", ["gig" => $gig]);
    }

    public function edit(Gig $gig)
    {
        return view("gigs.edit", ["gig" => $gig]);
    }

    public function update(Request $request, Gig $gig)
    {
        // make that the user in the owner
        if($gig->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $formField = $request->validate([
            "company" => ["required"],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email"],
            "website" => "required",
            "tags" => "required",
            "description" => "required",
        ]);

        if($request->hasFile("logo")){
            $formField["logo"] = $request->file("logo")->store("logos", "public");
        }

        $gig->update($formField);

        return redirect("/gigs/" . $gig->id)->with('success_message', 'Gig is Updating successfuly');
    }

    public function destroy(Gig $gig)
    {
        // make that the user in the owner
        if($gig->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }
        
        $gig->delete();
        return redirect("/")->with('success_message', 'Gig is Deleting successfuly');
    }

    // manage functio
    public function manage() {
        return view("/gigs.manage", ["gigs" => auth()->user()->gigs()->get()]);
    }
}
