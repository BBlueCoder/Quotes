<div class="col-xs-12">
    <x-card>
        <h5 class="card-title">
            <a href="/quotes/5" class="link-dark link-underline-opacity-0 link-underline-opacity-100-hover">{{$quote->author}}</a>
        </h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">
                By <a href="/user/{{$quote->user->username}}" class="link-secondary link-underline-opacity-0 link-underline-opacity-75-hover">{{$quote->user->username}}</a> on {{$quote->created_at}} </h6>
        <p class="card-text fst-italic">{{$quote->content}}</p>
    </x-card>
</div>