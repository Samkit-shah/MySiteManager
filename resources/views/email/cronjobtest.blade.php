<h3>Mail From MysiteManager To save the links</h3>

<div style="text-align: left;">
    <h4 style="text-transform: uppercase;font-size: 16px">hi test</h4>

    <hr>
</div>

{{-- Salutation --}}
@if(! empty($salutation))
    {{ $salutation }}
@else
    @lang('Regards'),<br>
        {{ config('app.name') }}<br>
        {{ config('app.url') }}
    @endif
