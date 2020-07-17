
    <div style="text-align: left;">

        <p style="font-size: 14px"> Welcome {{$name->name}}</p>

        <hr>
    </div>

{{-- Salutation --}}
@if (! empty($salutation))
    {{ $salutation }}
@else
    @lang('Regards'),<br>
    {{ config('app.name') }}<br>
    {{ config('app.url') }}
@endif
