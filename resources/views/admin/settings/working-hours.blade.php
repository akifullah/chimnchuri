@extends('admin.layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.working-hours.update') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Working Hours</h4>
            </div>
            <div class="card-body">
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp

                @foreach ($days as $index => $day)
                    @php
                        $hour = $workingHours->where('day', $day)->first();
                    @endphp
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-3">
                            <label class="form-label fw-bold">Day</label>
                            <input type="text" class="form-control bg-light" value="{{ $day }}" readonly>
                            <input type="hidden" name="working_hours[{{ $index }}][day]"
                                value="{{ $day }}">
                        </div>
                        <div class="col-lg-3">
                            <label for="open_time_{{ $index }}" class="form-label text-success">Open
                                Time</label>
                            <input type="time" id="open_time_{{ $index }}"
                                name="working_hours[{{ $index }}][open_time]"
                                value="{{ old("working_hours.$index.open_time", isset($hour->open_time) ? \Carbon\Carbon::parse($hour->open_time)->format('H:i') : '09:00') }}"
                                class="form-control">
                            @error("working_hours.$index.open_time")
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="close_time_{{ $index }}" class="form-label text-danger">Close
                                Time</label>
                            <input type="time" id="close_time_{{ $index }}"
                                name="working_hours[{{ $index }}][close_time]"
                                value="{{ old("working_hours.$index.close_time", isset($hour->close_time) ? \Carbon\Carbon::parse($hour->close_time)->format('H:i') : '22:00') }}"
                                class="form-control">
                            @error("working_hours.$index.close_time")
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <label class="form-label d-block cursor-pointer user-select-none">Is Closed</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="working_hours[{{ $index }}][is_closed]"
                                        value="0">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="working_hours[{{ $index }}][is_closed]" value="1"
                                        {{ old("working_hours.$index.is_closed", $hour->is_closed ?? 0) == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <hr class="text-muted opacity-25">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary w-100">Save Working Hours</button>
                </div>
            </div>
        </div>
    </form>
@endsection
