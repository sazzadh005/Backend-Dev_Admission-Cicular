<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class Applications extends Controller
{
    // Controller

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with(['user', 'portal'])->latest()->get();
        return view('admin.application', compact('applications'));
    }




    public function store(Request $request)
{
    $userId = Auth::id();
    $circularId = $request->portal_id;

    // Prevent duplicate applications
    if (Application::where('user_id', $userId)->where('portal_id', $circularId)->exists()) {
        return redirect()->back()->with('error', 'You have already applied for this portal.');
    }

    // Create application
    Application::create([
        'user_id' => $userId,
        'portal_id' => $circularId,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Application submitted successfully.');
}
public function update(Request $request, $id)
{
    // Validate the incoming status
    $validated = $request->validate([
        'status' => 'required|in:Approved,Rejected,Pending'
    ]);

    // Find the application
    $application = Application::findOrFail($id);

    // Update status (case-sensitive: DB column is "Status")
    $application->Status = $validated['status'];
    $application->save();

    return redirect()->route('applications.index')
                     ->with('success', 'Application status updated successfully.');
}

    public function list()
    {
        $userId = Auth::id();
        $applications = Application::with('portal')
                                   ->where('user_id', $userId)
                                   ->latest()
                                   ->get();
        return view('circulars.list', compact('applications'));
    }

}
