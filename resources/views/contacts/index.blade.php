@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📞 All Contacts</h2>
        <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Home</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contacts->isEmpty())
        <div class="alert alert-info">No contacts found.</div>
    @else
        <div class="row g-3">
            @foreach($contacts as $contact)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title d-flex align-items-center gap-2">
                                <img
                                    src="{{ $contact->person->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($contact->person->name) }}"
                                    alt="{{ $contact->person->name }}"
                                    class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                                <a href="{{ route('people.show', $contact->person->id) }}" class="text-decoration-none">
                                    {{ $contact->person->name }}
                                </a>
                            </h5>
                            <p class="mb-1">🌍 <strong>Country Code:</strong> {{ $contact->country_code }}</p>
                            <p class="mb-3">📱 <strong>Number:</strong> {{ $contact->number }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-info">View</a>
                                @auth
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
