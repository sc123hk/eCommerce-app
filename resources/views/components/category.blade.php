@php
    $categoryList = ['Asia', 'Europe', 'America', 'Africa'];
@endphp
<ul class="list-group">
    <a href="/listings/All"><li class="list-group-item list-group-item-action {{$filterCategory == 'All' ? 'active' : ''}}">All</li></a>
    @foreach ($categoryList as $category)
    <a href="{{route('listing.read',$category)}}"><li class="list-group-item list-group-item-action {{$filterCategory == $category ? 'active' : ''}}">{{$category}}</li></a>
    @endforeach
</ul>
