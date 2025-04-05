@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold fs-5 border-bottom">
                    {{ isset($contact) ? '✏️ Edit Contact' : '📞 Create Contact' }}
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

                    <form method="POST" action="{{ isset($contact) ? route('contacts.update', $contact) : route('contacts.store', $person->id ?? null) }}">
                        @csrf
                        @if (isset($contact))
                            @method('PUT')
                        @endif

                        {{-- Country Selector --}}
                        <div class="mb-3">
                            <label for="country_code" class="form-label">🌍 Country</label>
                            <select id="country_code" name="country_code" class="form-select @error('country_code') is-invalid @enderror" required>
                                <option value="">Select a country</option>
                                @foreach($callingCodes as $country)
                                    <option value="{{ $country['code'] }}" {{ old('country_code', $contact->country_code ?? '') == $country['code'] ? 'selected' : '' }}>
                                        {{ $country['name'] }} ({{ $country['code'] }})
                                    </option>
                                @endforeach
                            </select>
                            @error('country_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div class="mb-3">
                            <label for="number" class="form-label">📱 Number</label>
                            <input
                                type="text"
                                name="number"
                                id="number"
                                value="{{ old('number', $contact->number ?? '') }}"
                                class="form-control @error('number') is-invalid @enderror"
                                minlength="9"
                                maxlength="9"
                                required
                                pattern="\d{9}"
                            >
                            @error('number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success">
                                {{ isset($contact) ? '💾 Update Contact' : '✅ Create Contact' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#country_code').select2({
            placeholder: 'Select a country',
            width: '100%',
            dropdownParent: $('#country_code').closest('.card-body')
        });
    });
</script>
@endsection
