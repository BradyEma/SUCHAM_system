<p>Dear {{ $supplierName }},</p>

@if($result)
    <p>Congratulations! Your vendor application has been successfully validated.</p>

    @if($visitDate)
        <p>A facility visit has been scheduled on <strong>{{ \Carbon\Carbon::parse($visitDate)->format('F j, Y') }}</strong>.</p>
    @else
        <p>A facility visit has been scheduled. We’ll be in touch soon.</p>
    @endif

@else
    <p>Unfortunately, your vendor validation did not pass due to the following criteria:</p>
    <ul>
        @foreach($criteria as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@endif


<p>Thank you,<br>GoldenFields Team</p>
