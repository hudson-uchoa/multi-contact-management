@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold fs-5 border-bottom">
                    {{ isset($person) ? '🧑 Edit Person' : '👤 Create Person' }}
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>⚠️ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ isset($person) ? route('people.update', $person) : route('people.store') }}">
                        @csrf
                        @if (isset($person))
                            @method('PUT')
                        @endif

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">📝 Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $person->name ?? '') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                required
                                minlength="6"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">📧 Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $person->email ?? '') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Avatar Preview --}}
                        @if (isset($person) && $person->avatar_url)
                            <div class="mb-3">
                                <label class="form-label">🖼️ Current Avatar</label>
                                <div>
                                    <img src="{{ $person->avatar_url }}" alt="Avatar" height="100" class="rounded shadow-sm border">
                                </div>
                            </div>
                        @endif

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success">
                                {{ isset($person) ? '💾 Update Person' : '✅ Create Person' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
