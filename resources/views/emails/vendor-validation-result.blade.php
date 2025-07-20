<p>Dear {{ $supplierName }},</p>

@if($result)
    <p>Congratulations! Your vendor application has been successfully validated.</p>
    <p>A facility visit has been scheduled. We’ll be in touch soon.</p>
@else
    <p>Unfortunately, your application did not pass validation.</p>
    <p>The following issues were found:</p>
    <ul>
        @foreach($criteria as $fail)
            <li>{{ $fail }}</li>
        @endforeach
    </ul>
@endif

<p>Thank you,<br>GoldenFields Team</p>
