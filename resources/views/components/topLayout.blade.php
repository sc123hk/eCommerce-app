<div class="row">
    <div class="col-lg-9">
        <h2><i><a href="/" id="title">TripAnywhere</a></i></h2>
    </div>
    <div class="col-lg-3 button-group">
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <a href="{{route('order.index')}}" class="btn btn-success">Trips <i class="bi bi-airplane"></i></a> 
            <a href="{{route('cart.index')}}" class="btn btn-warning">Pins <i class="bi bi-pin-map"></i></a>  
            @auth
                <button type="submit" class="btn btn-secondary">Logout <i class="bi bi-door-open"></i></button>
            @endauth
        </form>
    </div>
</div>