<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <x-alert></x-alert>
            @foreach ($orders as $order)
                <form action="{{route('order.update')}}" method="POST">
                    @csrf
                    <div class="card" style="margin-bottom:2vh">
                        <div class="card-header">
                            {{$order->created_at}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Trip to <u>{{$order->title}}</u></h5>
                            <b class="card-text">Ticket: {{$order->quantity}}</b>
                            @if ($order->created_at == $order->updated_at)
                                <button type="submit" class="btn btn-secondary">Cancel <i class="bi bi-calendar-x"></i></button>
                            @else
                                <hr>
                                <p class="card-text">Refund query time: {{$order->updated_at}}</p>
                                <p class="card-text">Estimated completion time: {{$order->updated_at->modify('+15 days')}}</p>
                                <button class="btn btn-secondary" disabled>Processing <i class="bi bi-clock-history"></i></button>
                            @endif
                            <input type="hidden" name="id" value="{{$order->id}}">
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="col-lg-3"></div>
    </div>
</x-htmlSkeleton>
