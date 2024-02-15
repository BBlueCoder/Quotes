@extends('welcome')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-6 mt-4 p-3">
        <x-card>
            <div class="row d-flex align-items-center">
                <div class="col">
                    @if ( $user->profile_pic != null)
                        <img height="64px" width="64px" style="border-radius: 50%;object-fit: cover;" src="{{asset('storage/' . $user->profile_pic)}}" alt="profile picture">
                    @endif
                    <h3 class="d-inline ms-2">{{$user->username}}</h3>
                </div>
            </div>
        </x-card>
    </div>
</div>

@unless (count($quotes) == 0)
    <div class="row mt-5 row-gap-3">
        @foreach ($quotes as $quote)
            <x-quote-card :quote="$quote" /> 
        @endforeach
    </div>
@endunless



@endsection