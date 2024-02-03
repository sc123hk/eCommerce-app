@php
    $categoryList = ['Asia', 'Europe', 'America', 'Africa'];
@endphp
<ul class="list-group">
    <a href="/All"><li class="list-group-item list-group-item-action {{$filterValue == 'All' ? 'active' : ''}}">All</li></a>
    @foreach ($categoryList as $category)
    <a href="{{route('listing.filter',$category)}}"><li class="list-group-item list-group-item-action {{$filterValue == $category ? 'active' : ''}}">{{$category}}</li></a>
    @endforeach
</ul>
