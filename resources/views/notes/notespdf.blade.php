<h3 style="text-align: center">Saved Notes at MySiteManager</h3>
@foreach($note_details as $note)
    <div style="text-align: left;border: 2px solid darkblue;padding: 5px;margin-bottom: 5px">
        <h4 style="text-transform: capitalize;font-size: 16px;background-color: #4dc0b5;padding: 5px">
            {{ $note->topic }}</h4>
        @if($note->typeofnote == 'list')

            <ul>
                @foreach(unserialize($note->note_data) as $mynote)
                    <li>{{ $mynote }}</li>
                @endforeach
            </ul>
            <a style="font-size: 13px">Posted
                On
            </a>{{ $note->created_at->format('d/m/Y') }}

        @else

            <p style="text-align: justify;padding:5px">{{ $note->note_data }}</p>

            <a style="font-size: 13px">Posted
                On
            </a>{{ $note->created_at->format('d/m/Y') }}
        @endif

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
