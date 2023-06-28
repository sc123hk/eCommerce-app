<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="{{ route('cart.purchase') }}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr>
                                <th scope="col">{{ $item['title'] }}</th>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['price'] * $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th></th>
                            <td>Total:</td>
                            <td>{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-warning">Purchase <i class="bi bi-bag-check"></i></button>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</x-htmlSkeleton>
