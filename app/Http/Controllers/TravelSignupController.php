<?php

namespace App\Http\Controllers;

use App\Models\TravelSignup;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TravelSignupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myTravelSignups = TravelSignup::where('user_id', Auth::id())
            ->with(['travel.destination']) // Eager load travel and its destination
            ->latest()
            ->paginate(10);

        return view('travelsignup.index', [
            'myTravelSignups' => $myTravelSignups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'travel_id' => ['required'],
        ]);

        $validated['user_id'] = Auth::user()->id;

        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->store('travels', 'public');
        // }

        TravelSignup::create($validated);

        // $destination_id = $validated['destination_id'];
        return redirect("/travel-signups");
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelSignup $travelSignup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelSignup $travelSignup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelSignup $travelSignup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelSignup $travelSignup)
    {
        abort_unless(
            auth()->check() &&
                (auth()->user()->id === $travelSignup->user_id || auth()->user()->is_admin == true),
            403
        );

        $travelSignup->delete();

        return redirect("/travel-signups");
    }
}
