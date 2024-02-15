@extends('welcome')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-4 bg-dark-subtle mt-4 p-3 rounded">
        <h2 class="text-body-secondary">Add a quote</h2>
        <form action="/quote/save" method="post">
            @csrf

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>  
                <input type="text" class="form-control" name="author" value="{{old('author')}}">

                @error('author')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">content</label>  
                <textarea type="text" class="form-control" name="content" value="{{old('content')}}"></textarea>

                @error('content')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


@endsection