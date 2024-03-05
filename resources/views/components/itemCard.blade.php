<div class="col">
    <div class="card">
        <a href="{{route('listing.read',[$filterCategory,$listing->title])}}">
            <img src="{{asset("img/{$listing->id}.jpg")}}" class="card-img-top img-thumbnail" alt="...">
        </a>
        <div class="card-body">
            <h5 class="card-title"><a href="{{route('listing.read',[$filterCategory,$listing->title])}}">{{$listing->title}}</a></h5>
            <div class="card-text" style="padding-bottom: 5px">HKD {{$listing->price}}</div>
            <form method="POST" action="{{route('cart.create',[$listing->category,$listing->title])}}">
                @csrf
                <button type="submit" class="btn {{$listing->quantity == 0 ? 'btn-outline-secondary disabled' : 'btn-outline-primary'}} btn-sm">Add to Cart</a>
            </form>
        </div>
    </div>
</div>
