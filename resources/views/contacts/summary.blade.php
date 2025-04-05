@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🌍 Contacts per Country</h2>
        <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Home</a>
    </div>

    @if($summary->isEmpty())
        <div class="alert alert-info">No contacts found.</div>
    @else
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">🌐 Country Code</th>
                        <th class="text-center">📞 Number of Contacts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($summary as $row)
                        <tr>
                            <td class="text-center">+{{ $row->country_code }}</td>
                            <td class="text-center">{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
