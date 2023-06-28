<div class="row">
    <div class="col-lg-9">
        <h2><i><a href="/" id="title">Stephen's eShop</a></i></h2>
    </div>
    <div class="col-lg-3 button-group">
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <a href="{{route('order.index')}}" class="btn btn-success" id="cart">Order <i class="bi bi-receipt-cutoff"></i></a> 
            <a href="{{route('cart.index')}}" class="btn btn-warning" id="cart">Cart <i class="bi bi-cart3"></i></a>  
            <button type="submit" class="btn btn-secondary">Logout <i class="bi bi-door-open"></i></button>
        </form>
    </div>
</div>