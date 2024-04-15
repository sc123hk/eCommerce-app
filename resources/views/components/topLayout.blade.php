<div class="row">
    <div class="col-lg-9">
        <h2><i><a href="/" id="title">TripAnywhere</a></i></h2>
    </div>
    <div class="col-lg-3 button-group">
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <a href="{{route('order.read')}}" class="btn btn-success">Order <i class="bi bi-file-text"></i></a> 
            <a href="{{route('cart.read')}}" class="btn btn-warning">Cart <i class="bi bi-cart4"></i></a>  
            @if(Auth::check())
                <button type="submit" class="btn btn-secondary">Logout <i class="bi bi-door-open"></i></button>
            @else
                <a href="{{route('login')}}" class="btn btn-primary">Login <i class="bi bi-door-closed"></i></a> 
            @endif
        </form>
    </div>
</div>