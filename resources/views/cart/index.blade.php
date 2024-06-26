<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <x-alert></x-alert>
        <div class="col">
            {{-- <form action="{{route('cart.update')}}" method="POST">
            @csrf --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Listing</th>
                        <th scope="col">Number</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart == null)
                        <tr>
                            <th scope="col">No Listing in Cart!</th>
                            <td scope="col">-</td>
                            <td scope="col">-</td>
                        </tr>
                    @else
                        @foreach ($cart as $item)
                            <tr>
                                <th scope="col">{{ $item['title'] }}</th>
                                <td><input type="number" name="{{ $item['id'] }}" class="item-quantity form-control"
                                        value="{{ $item['quantity'] }}" min="0"></td>
                                <td>{{ $item['price'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if ($cart != null)
                <a href="{{ route('cart.checkout') }}" class="btn btn-success">Checkout <i
                        class="bi bi-cart-check"></i></a>
            @endif
            {{-- </form> --}}
        </div>
    </div>
</x-htmlSkeleton>
