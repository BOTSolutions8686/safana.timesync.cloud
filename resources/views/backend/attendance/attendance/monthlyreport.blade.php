<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="container mt-4">
    <div class="table-responsive">
        @if($recordsattend->isNotEmpty())
            <form action="{{ route('monthlyreport') }}" method="get" class="mb-4">
                @csrf
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="month">Select Month:</label>
                        <select name="month" id="month" class="form-control">
                            @foreach($months as $key => $month)
                                <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="year">Select Year:</label>
                        <select name="year" id="year" class="form-control">
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button style="margin-top: 18%" type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <ul class="list-unstyled">
                @foreach($recordsattend->groupBy('user_id') as $userId => $userRecords)
                    <li style="border: 1px solid #ccc; border-radius: 8px;" class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">User ID: {{ $userId }} - Name: {{ $userRecords->first()->user->name }}</h5>
                            <ul class="list-unstyled">
                                @php
                                    $currentMonth = null;
                                    $totalLateTime = 0;
                                    $expectedDates = [];
                                @endphp

                                <div style="display: flex; overflow-x: scroll;">
                                @foreach($userRecords as $monthlyreporta)
                                    @php
                                        $date = \Carbon\Carbon::parse($monthlyreporta->date);

                                        // Check if the current month has changed
                                        if ($currentMonth !== $date->format('F')) {
                                            // Reset expected dates for the new month
                                            $currentMonth = $date->format('F');
                                            $expectedDates = getExpectedDates($selectedYear, $selectedMonth);
                                        }

                                        // Remove the current date from expected dates if it exists
                                        $expectedDates = array_values(array_diff($expectedDates, [$date->format('Y-m-d')]));

                                        if ($monthlyreporta->late_time > 0) {
                                            $totalLateTime += $monthlyreporta->late_time;
                                        }
                                    @endphp

                                    <div>
                                        @if($currentMonth !== $date->format('F'))
                                            <li><strong>{{ $date->format('F') }}</strong></li>
                                            @php $currentMonth = $date->format('F'); @endphp
                                        @endif
                                        <div style="width: 180px;">
                                            <li style="margin-right: 40px">Date: {{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</li>
                                            <li style="margin-right: 40px">Check In: {{ \Carbon\Carbon::parse($monthlyreporta->check_in)->format('H:i') }}</li>
                                            <li style="margin-right: 40px">Check Out: {{ \Carbon\Carbon::parse($monthlyreporta->check_out)->format('H:i') }}</li>
                                            <li>Late Time: {{ $monthlyreporta->late_time }}</li>
                                        </div>
                                        <hr> 
                                    </div>
                                @endforeach
                                </div>

                                @php
    $totalMissingDates = 0; // Initialize counter for missing dates
@endphp

                                <!-- Display missing dates -->
                                @foreach($expectedDates as $missingDate)
                                    <div style="display: flex; flex-direction: column;">
                                        {{-- <li style="margin-right: 1px">Missing Date: {{ $missingDate }}</li> --}}
                                    </div>
                            
                                    @php
        $totalMissingDates++; // Increment counter for each missing date
    @endphp
                                @endforeach

                                {{-- <hr> --}}
                                <li>Total Minutes Late: {{ $totalLateTime }}</li>
                                <li>Total Hours Late: {{ number_format($totalLateTime / 60, 2) }}</li>
                                <li>Absent: {{ $totalMissingDates }}</li>
                                @php $totalLateTime = 0; @endphp <!-- Reset total late time for the next user -->
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
        <form action="{{ route('monthlyreport') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-row">
                <div class="col-md-3">
                    <label for="month">Select Month:</label>
                    <select name="month" id="month" class="form-control">
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="year">Select Year:</label>
                    <select name="year" id="year" class="form-control">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
            <p>No records found.</p>
        @endif
    </div>
</div>

@php
    function getExpectedDates($year, $month) {
        $daysInMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = \Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
        }
        return $dates;
    }
@endphp
