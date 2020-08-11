<h3 style="text-align: center">Saved Links at MySiteManager</h3>
@foreach($site_details as $site)
    <div style="text-align: left;border: 2px solid darkblue;padding: 5px;margin-bottom: 5px">
        <h4 style="text-transform: capitalize;font-size: 16px;background-color: #4dc0b5;padding: 5px">
            {{ $site->title }}</h4>
        <p style="font-size: 14px"> {{ $site->description }}</p>
        <p style="font-size: 18px">Site Link: <a
                style="color: cornflowerblue;text-decoration: underline">{{ $site->sitelink }}</a></p>
        <p style="font-size: 14px">Posted On </a>{{ $site->created_at->format('d/m/Y') }}
        </p>

    </div>
@endforeach



{{-- Salutation --}}
@if(! empty($salutation))
    {{ $salutation }}
@else
    @lang('Regards'),<br>
        {{ config('app.name') }}<br>
        <a href="{{ config('app.url') }}">{{ config('app.url') }}</a><br>
        For Any Queries Reach Us At: <a href="mailto:infomysitemanager@gmail.com">infomysitemanager@gmail.com</a>
    @endif
