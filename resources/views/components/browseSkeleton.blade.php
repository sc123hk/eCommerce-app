<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 20px">
            <x-category :filterValue="$filterValue ?? 'All'"/>
        </div>
        <div class="col-md-9">
            {{$slot}}
        </div>
    </div>
</x-htmlSkeleton>
