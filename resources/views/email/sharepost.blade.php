
<h3>Mail From MysiteManager To save the links</h3>
@foreach ($linkdata as $data)
<div style="text-align: left;">
<h4 style="text-transform: uppercase;font-size: 16px">  {{$data->title}}</h4>
<p style="font-size: 14px"> {{$data->description}}</p>
<p style="font-size: 18px">Site Link {{$data->sitelink}}</p>
<p style="font-size: 14px">Posted On </a>{{$data->created_at->format('d/m/Y')}}</p>
<hr>
</div>
@endforeach
{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}<br>
{{ config('app.url') }}
@endif


