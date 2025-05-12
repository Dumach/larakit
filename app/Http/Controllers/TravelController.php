<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Destination;
use App\Models\TravelSignup;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Destination $destination)
    {
        return view('destination.travel.create', [
            'destination' => $destination,
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => ['min:0', 'integer', 'required'],
            // 'description' => ['required', 'string'],
            'date' => ['date', 'required'],
            // 'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'destination_id' => ['required'],
        ]);

        // $validated['user_id'] = Auth::user()->id;

        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->store('travels', 'public');
        // }

        Travel::create($validated);

        $destination_id = $validated['destination_id'];
        return redirect("/destinations/$destination_id");
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination, Travel $travel)
    {

        abort_unless(auth()->check() && 
        (auth()->user()->id == $travel->destination->created_by || auth()->user()->is_admin == true),
         403);

        return view('destination.travel.edit', [
            'travel' => $travel,
            'destination' => $travel->destination(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Destination $destination ,Travel $travel)
    {
        $validated = request()->validate([
            'price' => ['min:0', 'integer', 'required'],
            // 'description' => ['required', 'string'],
            'date' => ['date', 'required'],
            // 'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'destination_id' => ['required'],
        ]);


        abort_unless(auth()->check() && 
        (auth()->user()->id == $travel->destination->created_by || auth()->user()->is_admin == true),
         403);

        // if ($request->has('removeImage') && $travel->image && Storage::disk('public')->exists($travel->image)) {
        //     Storage::disk('public')->delete($travel->image);
        // }


        // if ($request->hasFile('image')) {
        //     if ($travel->image && Storage::disk('public')->exists($travel->image)) {
        //         Storage::disk('public')->delete($travel->image);
        //     }

        //     $validated['image'] = $request->file('image')->store('travels', 'public');
        // } elseif ($request->has('removeImage')) {
        //     $validated['image'] = null;
        // }

        $travel->update($validated);

        $destination_id = $request->get('destination_id');

        return redirect("/destinations/$destination_id")->with('success', 'Image saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination, Travel $travel)
    {
        // $travel = Travel::query()->where('id', '=', $id)->first();

        abort_unless(
            auth()->check() &&
                (auth()->user()->id === $destination->user_id || auth()->user()->is_admin == true),
            403
        );

        // if ($travel->image && Storage::disk('public')->exists($travel->image)) {
        //     Storage::disk('public')->delete($travel->image);
        // }

        // abort_unless($travel->user_id === Auth::user()->id, 403);

        $travel->delete();

        return redirect("/destinations/$destination->id");
    }
}
