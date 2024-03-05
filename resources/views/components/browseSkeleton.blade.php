<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 20px">
            <x-category :filterCategory="$filterCategory ?? 'All'"/>
        </div>
        <div class="col-md-9">
            <nav aria-label="breadcrumb" style="padding-left: 1vw">
                <ol class="breadcrumb">
                    @php
                        $urlArr = explode('/',request()->getRequestUri());
                        array_shift($urlArr);
                        array_shift($urlArr);
                        //dd($urlArr);
                    @endphp
                    @foreach ($urlArr as $item)
                        @if (!$loop->last)
                            <li class="breadcrumb-item"><a href="/listings/{{$item}}">{{urldecode($item)}}</a></li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{urldecode($item)}}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
            {{$slot}}
        </div>
    </div>
</x-htmlSkeleton>
