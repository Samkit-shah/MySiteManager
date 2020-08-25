<h3>Mail From MysiteManager</h3>
@foreach($notedata as $note)
    <div style="text-align: left;">
        <h4 style="text-transform: uppercase;font-size: 16px"> {{ $note->topic }}</h4>
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
        <hr>
    </div>
@endforeach
{{-- Salutation --}}
@if(! empty($salutation))
    {{ $salutation }}
@else
    @lang('Regards'),<br>
        {{ config('app.name') }}<br>
        {{ config('app.url') }}
    @endif
