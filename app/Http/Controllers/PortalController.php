<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
       // First, check if a user is authenticated.
    if (auth()->check()) {
        // If a user is logged in, check if they are an admin.
        if (auth()->user()->role === 'admin') {
            // If the user is an admin, fetch all circulars.
            $circulars = Portal::all();
        } else {
            // If the user is logged in but NOT an admin, fetch only active circulars.
            $circulars = Portal::where('Status', 'Active')->get();
        }
    } else {
        // If no user is authenticated (a guest), fetch only active circulars.
        $circulars = Portal::where('Status', 'Active')->get();
    }

    return view("circulars.index", compact("circulars"));
    }

    public function create()
    {
        return view("circulars.create");
    }
    public function store(Request $request){
        
        $validate = $request->validate([
            "UniversityName" => "required|string|max:255",
            "ProgramName" => "required|string|max:255",
            "Description" => "nullable|string",
            "Link" => "nullable|url|max:255",
            "ApplicationDeadline" => "nullable|date",
        ]); 
        Portal::create($validate);
        return redirect()->route("circulars.index")->with("success", "Circular created successfully.");      
    }

    public function show(string $id)
    {
        $circular = Portal::find($id);
        return view("circulars.show", compact("circular"));   
    }

    public function edit(string $id)
    {
        $circular = Portal::find($id);
        return view("circulars.edit", compact("circular"));
    }

    public function update(Request $request, string $id)
    {
        $circular = Portal::find($id);
        $validate = $request->validate([
            "UniversityName" => "required|string|max:255",
            "ProgramName" => "required|string|max:255",
            "Description" => "nullable|string",
            "Link" => "nullable|url|max:255",
            "ApplicationDeadline" => "nullable|date",
        ]); 
        $circular->update($validate);
        return redirect()->route("circulars.index")->with("success", "Circular updated successfully.");
    }

    public function destroy(string $id)
    {
        $circular = Portal::find($id);
        $circular->delete();
        return redirect()->route("circulars.index")->with("success", "Circular deleted successfully.");
    }


}