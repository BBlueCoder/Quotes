@extends('welcome')

@section('content')

<div class="">
    <a href="/quote/create" class="btn btn-dark">Add a quote</a>
</div>
@unless (count($quotes) == 0)
    <div class="row mt-5 row-gap-3">
        @foreach ($quotes as $quote)
            <x-quote-card :quote="$quote" /> 
        @endforeach
    </div>
@else
    <h2>No Quotes</h2>
@endunless



@endsection