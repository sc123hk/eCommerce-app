<x-htmlSkeleton>
    <x-topLayout></x-topLayout>
    <div class="row">
        <div class="col-3">
            <fieldset>
                <legend>Show Product</legend>
                <label class="col-form-label">Title</label>
                <select class="form-select" id="showTitle">
                    @foreach ($listings as $listing)
                        <option value="{{$listing->id}}" selected>{{$listing->title}}</option>
                    @endforeach
                </select>
                <label class="col-form-label">Category</label>
                <input type="text" class="form-control" id="showCategory" readonly disabled>
                <label class="col-form-label">Description</label>
                <textarea class="form-control" id="showDescription" readonly disabled></textarea>
                <label class="col-form-label">Price</label>
                <input type="number" class="form-control" id="showPrice" readonly disabled>
                <label class="col-form-label">Quantity</label>
                <input type="number" class="form-control" id="showQuantity" readonly disabled>
                <br>
                <button id="showProductBtn" class="btn btn-warning">Show</button>
            </fieldset>
        </div>
        <div class="col-3">
            <form method="POST" action="{{route('admin.create')}}" enctype="multipart/form-data"> 
                @csrf
                @method('POST')
                <fieldset>
                    <legend>Add Product</legend>
                    <label class="col-form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                    <label class="col-form-label">Category</label>
                    <select class="form-select" name="category">
                        <option value="Asia" selected>Asia</option>
                        <option value="Europe">Europe</option>
                        <option value="America">America</option>
                        <option value="Africa">Africa</option>
                    </select>
                    <label class="col-form-label">Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                    <label class="col-form-label">Price</label>
                    <input type="number" class="form-control" name="price" required>
                    <label class="col-form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" required>
                    <label class="col-form-label">Image</label>
                    <input class="form-control" type="file" name="image" required>
                    <br>
                    <button type="submit" class="btn btn-success">Add</button>
                </fieldset>
            </form>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-3">
            <form method="POST" action="{{route('admin.update')}}" enctype="multipart/form-data"> 
                @csrf
                @method('PATCH')
                <fieldset>
                    <legend>Update Product</legend>
                    <label class="col-form-label">Title</label>
                    <select class="form-select" name="listingId">
                        @foreach ($listings as $listing)
                            <option value="{{$listing->id}}" selected>{{$listing->title}}</option>
                        @endforeach
                    </select>
                    <label class="col-form-label">Category</label>
                    <select class="form-select" name="category">
                        <option value="Asia">Asia</option>
                        <option value="Europe">Europe</option>
                        <option value="America">America</option>
                        <option value="Africa">Africa</option>
                    </select>
                    <label class="col-form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                    <label class="col-form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                    <label class="col-form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity">
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </fieldset>
            </form>
        </div>
        <div class="col-3">
            <form method="POST" action="{{route('admin.delete')}}"> 
                @csrf
                @method('DELETE')
                <fieldset>
                    <legend>Delete Product</legend>
                    <label class="col-form-label">Title</label>
                    <select class="form-select" name="listingId">
                        @foreach ($listings as $listing)
                            <option value="{{$listing->id}}" selected>{{$listing->title}}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </fieldset>
            </form>
        </div>
    </div>
</x-htmlSkeleton>