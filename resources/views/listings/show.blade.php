<x-browseSkeleton :filterCategory="$filterCategory">
    <x-alert></x-alert>
    <div class="row">
        <div class="col-lg-6">
            <x-carousel :listing="$listing"></x-carousel>
        </div>
        <div class="col-lg-6" style="text-align: left; margin-top: 10px; margin-bottom: 30px; padding-left: 20px">
            <h3>{{$listing->title}}</h3>
            <h5>HKD {{$listing->price}}</h5>
            <hr>
            <form method="POST" action="{{route('cart.create',[$listing->category,$listing->title])}}">
                @csrf
                <button type="submit" class="btn {{$listing->quantity == 0 ? 'btn-secondary disabled' : 'btn-primary'}}">Add to Cart</button>
                &nbsp;&nbsp;
                <span>{{$listing->quantity}} remaining</span>
            </form>
            <hr>
            <i>{{$listing->description}}</i>
        </div>
    </div>
</x-browseSkeleton>
