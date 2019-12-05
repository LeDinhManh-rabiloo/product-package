<div class="d-inline-block">
    <div class="col-sm-10">
        @foreach($model->getMedia('product') as $key => $image)
            @if($key == 0)
                <img src="{{ $image->getFullUrl() }}" alt="">
            @endif
        @endforeach
    </div>
</div>
