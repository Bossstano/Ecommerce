<form action="{{route('products.search')}}" class=" d-flex mr-3">

    <div class="input-group">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Rechercher" value="{{request()->q ?? '' }}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-info "><i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </div>

</form>
