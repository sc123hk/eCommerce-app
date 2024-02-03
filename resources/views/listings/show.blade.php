<x-browseSkeleton :filterValue="$filterValue">
    <x-alert></x-alert>
    <div class="row">
        <div class="col-lg-6">
            <x-carousel :listing="$listing"></x-carousel>
        </div>
        <div class="col-lg-6" style="text-align: left; margin-top: 10px; margin-bottom: 30px; padding-left: 20px">
            <h3>{{ $listing->title }}</h3>
            <h5>HKD {{ $listing->price }}</h5>
            <hr>
            <a href="{{request()->url()}}/store" class="btn {{$listing->quantity == 0 ? 'btn-secondary' : 'btn-primary'}}">
                {{$listing->quantity == 0 ? 'Quota Full' : 'Pin to Map'}} <i class="bi bi-pin-map"></i>  
            </a>&nbsp;&nbsp;
            <span>{{ $listing->quantity }} remaining</span>
            <hr>
            <i>{{ $listing->description }}</i>
        </div>
    </div>
</x-browseSkeleton>
