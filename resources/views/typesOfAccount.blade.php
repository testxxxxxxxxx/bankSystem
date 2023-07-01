@include('partials/_header')

@isset($typesOfAccount)

    @foreach($typesOfAccount as $types)

        {{$types->id}} <br>
        {{$types->name}} <br>
        {{$types->interest_id}} <br>

    @endforeach

@endisset

@include('partials/_footer')