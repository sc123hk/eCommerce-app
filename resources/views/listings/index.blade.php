<x-browseSkeleton :filterCategory="$filterCategory ?? 'All'">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($listings as $listing)
            <x-itemCard :listing="$listing" :filterCategory="$filterCategory ?? 'All'" />
        @endforeach
    </div>
</x-browseSkeleton>
