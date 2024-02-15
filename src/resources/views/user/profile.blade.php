@extends('welcome')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-6 mt-4 p-3">
        <x-card>
            <div class="row d-flex align-items-center">
                <div class="col">
                    @if ( auth()->user() != null && auth()->user()->profile_pic != null)
                        <img height="64px" width="64px" style="border-radius: 50%;object-fit: cover;" src="{{asset('storage/' . auth()->user()->profile_pic)}}" alt="profile picture">
                    @endif
                    <h3 class="d-inline ms-2">{{auth()->user()->username}}</h3>
                </div>
            </div>
            <div class="row d-flex align-items-center mt-5">
                <div class="col-3 text-end">
                    <label class="form-label">Email</label>
                </div>
                <div class="col-5 text-start">
                    <input class="form-control" type="email" name="email" value="{{auth()->user()->email}}" disabled readonly>
                </div>
            </div>
        </x-card>
    </div>
</div>

@endsection