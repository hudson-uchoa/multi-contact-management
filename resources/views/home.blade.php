@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">Welcome to the People & Contacts Manager</h1>

    <div class="row g-4">
        <!-- Manage People -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">👤 Manage People</h5>
                    <p class="card-text">View, add, edit or remove people from the system.</p>
                    <a href="{{ route('people.index') }}" class="btn btn-primary">Go to People List</a>
                </div>
            </div>
        </div>

        <!-- Manage Contacts -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">📞 Manage Contacts</h5>
                    <p class="card-text">Add or edit contacts for existing people.</p>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Go to Contacts</a>
                </div>
            </div>
        </div>

        <!-- Contact Stats -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">🌎 Contact Stats</h5>
                    <p class="card-text">View the number of contacts per country.</p>
                    <a href="{{ route('contacts.summary') }}" class="btn btn-primary">View Stats</a>
                </div>
            </div>
        </div>

        <!-- Admin Area -->
        @auth
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Admin Area</h5>
                    <p class="card-text">Manage the system (edit/delete access).</p>
                    <a href="#" class="btn btn-secondary disabled">Coming Soon</a>
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection
