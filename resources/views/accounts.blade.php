@include('partials/_header')

<div class="container">

    @isset($res)

        @foreach($res as $r)
            {{$r->id}} <br>
            {{$r->balance}} <br>
            {{$r->user_id}} <br>
        
        @endforeach

    @endisset

</div>

@include('partials/_footer')