@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
        <img src="https://img.icons8.com/office/16/000000/facebook-new.png" alt="" width="120px">
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
            Si no deseas recibir más correos, puedes modificar tus preferencias unsubscribe .
        @endcomponent
    @endslot
@endcomponent
