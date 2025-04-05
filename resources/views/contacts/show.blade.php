@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Contact Details</h2>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">← Back to Contacts</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center gap-3 mb-4">
                <img
                    src="{{ $contact->person->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($contact->person->name) }}"
                    alt="{{ $contact->person->name }}"
                    class="rounded-circle"
                    style="width: 60px; height: 60px; object-fit: cover;">
                <div>
                    <h4 class="mb-0">
                        <a href="{{ route('people.show', $contact->person->id) }}" class="text-decoration-none">
                            {{ $contact->person->name }}
                        </a>
                    </h4>
                    <small class="text-muted">👤 Person</small>
                </div>
            </div>

            <div class="mb-3">
                <strong>🌍 Country Code:</strong> {{ $contact->country_code }}
            </div>

            <div class="mb-3">
                <strong>📱 Number:</strong> {{ $contact->number }}
            </div>

            @auth
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">✏️ Edit</a>

                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this contact?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
