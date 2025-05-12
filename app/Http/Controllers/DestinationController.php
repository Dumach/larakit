<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdminMiddleware;

use App\Models\Destination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchBy = $request->input('searchBy', 'Name');

        $searchQuery = Destination::query()->with('travels');


        if ($search) {
            $searchQuery->search($searchBy, $search);
        }

        // Sorrend
        $orderBy = $request->input('orderBy', 'created_at');
        $direction = $request->input('direction', 'asc');

        $searchQuery->orderBy($orderBy, $direction);


        // Lekérdezés
        // $unfinished = $unfinishedQuery->paginate(5,['*'], 'unfinished_page');
        $destinations = $searchQuery/*->latest()*/->paginate(10);

        return view('destination.index', [
            'destinations' => $destinations,
            'search' => $search,
            'searchBy' => $searchBy,
            'orderBy' => $orderBy,
            'direction' => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('destination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
            'vehicle' => ['required', 'string'],
            // 'label' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);
        abort_unless(auth()->check(), 403);

        $validated['created_by'] = Auth::user()->id;


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
            //     $validated['image'] = $request->file('image')->store('albums', 'public');

            //     Image::read(Storage::disk('public')->get($validated['image']))
            //         ->scale(215, 160)
            //         ->save(Storage::disk('public')->path($validated['image']));
            // } elseif ($request->has('removeImage')) {
            //     $validated['image'] = null;
        }

        // Store db
        Destination::create($validated);

        return redirect(route('destinations.index'))->with('success', 'Destination saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('destination.show', [
            'destination' => $destination,
            'travels' => $destination->travels()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('destination.edit', [
            'destination' => $destination
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = request()->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
            'vehicle' => ['required', 'string'],
            // 'label' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);

        abort_unless(auth()->check() && auth()->user()->id === $destination->created_by, 403);

        if ($request->has('removeImage') && $destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
            //     $validated['image'] = $request->file('image')->store('albums', 'public');

            //     Image::read(Storage::disk('public')->get($validated['image']))
            //         ->scale(215, 160)
            //         ->save(Storage::disk('public')->path($validated['image']));
            // } elseif ($request->has('removeImage')) {
            //     $validated['image'] = null;
        }


        if ($request->hasFile('image')) {
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }

            $validated['image'] = $request->file('image')->store('destinations', 'public');
        } elseif ($request->has('removeImage')) {
            $validated['image'] = null;
        }

        $destination->update($validated);

        return redirect(route('destinations.index'))->with('success', 'Image saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        abort_unless(
            auth()->check() &&
                (auth()->user()->id === $destination->created_by || auth()->user()->is_admin == true),
            403
        );

        // abort_unless(auth()->check() && auth()->user()->id === $destination->created_by, 403);

        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect(route('destinations.index'))->with('success', 'Destination deleted');
    }
}
