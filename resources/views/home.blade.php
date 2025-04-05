@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Welcome to the People & Contacts Manager</h1>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">👤 Manage People</h5>
                    <p class="card-text">View, add, edit or remove people from the system.</p>
                    <a  class="btn btn-primary">Go to People List</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📞 Manage Contacts</h5>
                    <p class="card-text">Add or edit contacts for existing people.</p>
                    <a  class="btn btn-primary">Go to Contacts</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🌎 Contact Stats</h5>
                    <p class="card-text">View the number of contacts per country.</p>
                    <a  class="btn btn-primary">View Stats</a>
                </div>
            </div>
        </div>

        @auth
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Admin Area</h5>
                    <p class="card-text">Manage the system (edit/delete access).</p>
                    <a  class="btn btn-secondary">Go to Admin</a>
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection
