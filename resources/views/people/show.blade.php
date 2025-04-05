@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🧑 Person Details</h2>
        <a href="{{ route('people.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Person Info --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $person->avatar_url }}" alt="Avatar" class="rounded-circle me-4 border" height="100" width="100" style="object-fit: cover;">
            <div>
                <h4 class="mb-1">{{ $person->name }}</h4>
                <p class="mb-2 text-muted">📧 {{ $person->email }}</p>

                @auth
                    <div class="d-flex gap-2">
                        <a href="{{ route('people.edit', $person) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('people.destroy', $person) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this person?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Delete</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- Contacts --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5>📱 Contacts</h5>
            @auth
                <a href="{{ route('contacts.create', $person->id) }}" class="btn btn-primary btn-sm">
                    ➕ Add Contact
                </a>
            @endauth
        </div>

        @if ($person->contacts->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">🌐 Country Code</th>
                            <th class="text-center">📞 Number</th>
                            <th class="text-center" style="width: 220px;">⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($person->contacts as $contact)
                            <tr>
                                <td class="text-center">+{{ $contact->country_code }}</td>
                                <td class="text-center">{{ $contact->number }}</td>
                                <td class="text-center">
                                    <a href="{{ route('contacts.show',  $contact) }}" class="btn btn-info btn-sm">👁️ View</a>
                                    @auth
                                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <form action="{{ route('contacts.destroy',  $contact) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">🗑️</button>
                                        </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No contacts found for this person.</p>
        @endif
    </div>
</div>
@endsection
