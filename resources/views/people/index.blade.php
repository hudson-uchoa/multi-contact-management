@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👥 People</h2>
        <div class="d-flex gap-2">
            @auth
                <a href="{{ route('people.create') }}" class="btn btn-primary">➕ Add New Person</a>
            @endauth
            <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Home</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($people->isEmpty())
        <div class="alert alert-info">No people found.</div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>🖼️ Avatar</th>
                        <th>🧑 Name</th>
                        <th>📧 Email</th>
                        <th style="width: 220px;">⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                        <tr>
                            <td>
                                <img src="{{ $person->avatar_url }}" alt="Avatar" class="rounded-circle border" style="height: 50px; width: 50px; object-fit: cover;">
                            </td>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('people.show', $person->id) }}" class="btn btn-sm btn-info">👁️ View</a>
                                    @auth
                                        <a href="{{ route('people.edit', $person->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                        <form action="{{ route('people.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                        </form>
                                    @endauth
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
