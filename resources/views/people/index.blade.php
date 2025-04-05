@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>People</h2>
        <a href="{{ route('people.create') }}" class="btn btn-primary">+ Add New Person</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($people->isEmpty())
        <div class="alert alert-info">No people found.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                        <tr>
                            <td>
                                <img src="{{ $person->avatar_url }}" alt="Avatar" class="rounded" style="height: 50px;">
                            </td>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->email }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('people.show', $person->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('people.edit', $person->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('people.destroy', $person->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this person?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
