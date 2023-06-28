<x-browseSkeleton :filterValue="$filterValue">
    <x-alert></x-alert>
    <div class="row">
        <div class="col-lg-6">
            <x-carousel :listing="$listing"></x-carousel>
        </div>
        <div class="col-lg-6" style="text-align: left; color: white; text-shadow: 1px 1px black; margin-top: 10px; margin-bottom: 30px">
            <h3>{{ $listing->title }}</h3>
            <h5>HKD {{ $listing->price }}</h5>
            <hr>
            <a href="{{request()->url()}}/store" class="btn {{$listing->quantity == 0 ? 'btn-secondary' : 'btn-primary'}}">
                {{$listing->quantity == 0 ? 'Sold out' : 'Add to Cart'}} <i class="bi bi-cart-plus"></i>  
            </a>&nbsp;&nbsp;
            <span>{{ $listing->quantity }} remaining</span>
            <hr>
            <i>{{ $listing->description }}</i>
        </div>
    </div>
</x-browseSkeleton>
