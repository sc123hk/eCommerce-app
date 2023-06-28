<div class="col">
    <div class="card">
        <img src="{{asset("img/{$listing->picture}.jpg")}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><a href="{{route('listing.show',[$filterValue,$listing->picture])}}">{{$listing->title}}</a></h5>
            <span class="card-text">HKD {{$listing->price}}</span>
        </div>
    </div>
</div>
