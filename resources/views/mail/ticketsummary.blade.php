@component('mail::message')

Dear {{ $name }},

Here is your summary of unprocessed tickets

<ul>
@foreach($tickets as $t)
<li>{{ $t['subject'] }}</li>
@endforeach
</ul>

@endcomponent
