@include('partials/_header')

<div class="container">

    @isset($accounts)

        @foreach($accounts as $account)
            {{$account->id}} <br>
            {{$account->balance}} <br>
            {{$account->user_id}} <br>
        
        @endforeach

    @endisset

    @isset($typesOfAccounts)

        <div class="row form-group">

                <select id="typeOfAccount" class="form-control">

                    @foreach($typesOfAccounts as $type)

                        <option value="{{$type->id}}">{{$type->name}}</option>

                    @endforeach

                </select>

                <button id="sendButton">create</button>

        </div>

    @endisset

</div>

    @vite(['resources/js/app.js'])

@include('partials/_footer')