<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contact;
use App\Models\Person;
use App\Services\CountryServiceInterface;
use DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    protected CountryServiceInterface $countryService;

    public function __construct(CountryServiceInterface $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('person')->get();

        return view('contacts.index', compact('contacts'));
    }

    public function summaryByCountry()
    {
        $summary = Contact::select('country_code', DB::raw('count(*) as total'))
            ->groupBy('country_code')
            ->orderBy('country_code')
            ->get();

        return view('contacts.summary', compact('summary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Person $person)
    {
        $callingCodes = $this->countryService->getCallingCodes();
        // dd($callingCodes);
        return view('contacts.form', [
            'person' => $person,
            'callingCodes' => $callingCodes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request, Person $person)
    {
        $data = $request->validated();
        $data['person_id'] = $person->id;

        Contact::create($data);

        return redirect()
            ->route('people.show', $person->id)
            ->with('success', 'Contact created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $callingCodes = $this->countryService->getCallingCodes();

        return view('contacts.form', [
            'contact' => $contact,
            'person' => $contact->person,
            'callingCodes' => $callingCodes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return redirect()
            ->route('people.show', $contact->person_id)
            ->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Contact deleted!');
    }
}
