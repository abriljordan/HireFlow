<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search', 'job_type', 'experience_level', 'date_posted']))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            'salary' => 'nullable|string',
            'job_type' => 'required|in:full-time,part-time,contract,freelance,internship',
            'experience_level' => 'required|in:entry,junior,mid,senior,lead,executive',
            'application_deadline' => 'nullable|date|after:today'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Job listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            'salary' => 'nullable|string',
            'job_type' => 'required|in:full-time,part-time,contract,freelance,internship',
            'experience_level' => 'required|in:entry,junior,mid,senior,lead,executive',
            'application_deadline' => 'nullable|date|after:today'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Job listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        
        $listing->delete();
        return redirect('/')->with('message', 'Job listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }

    // Apply for a job
    public function apply(Listing $listing) {
        // Check if application is still open
        if (!$listing->isApplicationOpen()) {
            return back()->with('error', 'Applications for this position are closed.');
        }

        // For now, we'll just redirect to email with pre-filled subject
        $subject = "Application for " . $listing->title . " at " . $listing->company;
        $body = "Dear Hiring Manager,\n\nI am writing to express my interest in the " . $listing->title . " position at " . $listing->company . ".\n\n[Your application content here]\n\nBest regards,\n[Your name]";
        
        $mailto = "mailto:" . $listing->email . "?subject=" . urlencode($subject) . "&body=" . urlencode($body);
        
        return redirect($mailto);
    }
} 