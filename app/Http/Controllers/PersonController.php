<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::get();
        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('people.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {

        $person = Person::withTrashed()->where('email', $request->email)->first();

        if ($person && $person->trashed()) {
            $person->restore();
            $person->update($request->validated());
        }else{
            Person::create($request->validated());
        }


        return redirect()->route('people.index')->with('success', 'Person has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return view('people.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return view('people.form', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return redirect()
            ->route('people.index')
            ->with('success', 'Person has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        try {
            $person->delete();

            return redirect()->route('people.index')
                ->with('success', 'Person has been deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('people.index')
                ->with('error', 'Failed to delete the person.');
        }
    }
}
