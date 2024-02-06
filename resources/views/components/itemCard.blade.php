<div class="col">
    <div class="card">
        <a href="{{route('listing.show',[$filterValue,$listing->title])}}">
            <img src="{{asset("img/{$listing->picture}.jpg")}}" class="card-img-top img-thumbnail" alt="...">
        </a>
        <div class="card-body">
            <h5 class="card-title"><a href="{{route('listing.show',[$filterValue,$listing->title])}}">{{$listing->title}}</a></h5>
            <div class="card-text" style="padding-bottom: 5px">HKD {{$listing->price}}</div>
            <a href="{{route('cart.store',[$listing->category,$listing->title])}}" type="button" class="btn btn-outline-primary btn-sm">Pin to Map</a>
        </div>
    </div>
</div>
