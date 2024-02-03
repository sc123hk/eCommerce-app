<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 20px">
            <x-category :filterValue="$filterValue ?? 'All'"/>
        </div>
        <div class="col-md-9">
            <nav aria-label="breadcrumb" style="padding-left: 1vw">
                <ol class="breadcrumb">
                    @php
                        $urlArr = explode('/',request()->getRequestUri());
                        $urlArr[0] = 'All';
                    @endphp
                    @if (count($urlArr) == 2 && $urlArr[1] == 'All')
                        <li class="breadcrumb-item active" aria-current="page">All</li>
                    @else
                        @foreach ($urlArr as $item)
                            @if ($item == 'All' && !$loop->first)
                                @continue
                            @endif
                            @if (!$loop->last)
                                <li class="breadcrumb-item"><a href="/{{$item}}">{{urldecode($item)}}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{urldecode($item)}}</li>
                            @endif
                        @endforeach
                    @endif
                    {{-- <li class="breadcrumb-item"><a href="/">{{url()->current()}}</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
            {{$slot}}
        </div>
    </div>
</x-htmlSkeleton>
