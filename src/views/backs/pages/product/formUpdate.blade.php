{!! Form::open(['url' => [$route], 'method' => $method, 'files' => true]) !!}
<div class="list-file-delete">

</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {{ Form::label('product_images', __('Product images')) }}
    <div class="row col-md-12 mb-4" id="image_container" style="padding: 0px;">
        <input type="hidden" id="hidden_medias" name="medias" value="[]" />
        <div class="col-md-12 clearfix list-image">
            @php $i = 1 @endphp
            @foreach($product->getMedia('product') as $image)
                <div id="upload-file-1" class="float-left col-sm-2 mr-2">
                    <input type="hidden" name="old_image[]" value="{{ $image->id }}" class="d-none">
                    <div class="preview-file mt-1" style="display: block">
                        <i class="far fa-trash-alt icon-delete-image" data_key="{{ $i }}" data_id="{{ $image->id }}"></i>
                        <img src="{{ $image->getFullUrl() }}" class="img-fluid">
                    </div>
                </div>
                @php $i = $i + 1; @endphp
            @endforeach
            <div id="upload-file-{{ $i }}" class="col-sm-2 float-left mr-2">
                <div class="upload-file">
                    <img src="{{ asset('images/icon/images.png') }}" class="img-fluid" style="width: 100px;">
                    <input type="file" name="image_product[]" class="image-product" data_key="{{ $i }}" multiple>
                </div>
                <div class="preview-file mt-1">
                    <i class="far fa-trash-alt icon-delete-image" data_key="{{ $i }}"></i>
                    <img src="{{ asset('images/icon/images.png') }}" class="img-fluid d-none" id="img-1">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tab panes -->
<div class="form-group">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', $product->productInfor[0]->name ?? null, ['class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('price', __('Price')) }}
    {{ Form::number('price', $product->price ?? null, ['class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('quantity', __('Quantity')) }}
    {{ Form::text('qty', $product->qty ?? null, ['class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('category', __('Category')) }}
    {{ Form::select('cate_product_id', $category ?? null, $product->cate_product_id,
    ['id' => "category", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('url_key', __('Url key')) }}
    {{ Form::text('url_key', $product->productInfor[0]->url_key ?? null,['class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('meta_title', __('Meta title')) }}
    {{ Form::textarea('meta_title', $product->productInfor[0]->meta_title ?? null, ['class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('meta_description', __('Meta description')) }}
    {{ Form::textarea('meta_description', $product->productInfor[0]->meta_description ?? null, ['class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('short_description', __('Short description')) }}
    {{ Form::textarea('short_description', $product->productInfor[0]->short_description ?? null, ['class' => "form-control"]) }}
</div>

<!-- Tab panes -->
<div class="form-group">
    {{ Form::label('description', __('Description')) }}
    {{ Form::textarea('description', $product->productInfor[0]->description ?? null, ['name' => "description", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {!! Form::label('select_activate', __('select Activate')) !!}
    <div class="ml-2 ml-md-4">
        <div class="custom-control custom-checkbox custom-control-inline">
            {!! Form::radio('active', 1, null, [
                'id' => 'activate',
                'class' => 'custom-control-input',
                $product->active == 1 ? 'checked' : ''
            ]) !!}
            <label class="custom-control-label" for="activate">
                {{ ucfirst('Activate') }}
            </label>
        </div>
        <div class="custom-control custom-checkbox custom-control-inline">
            {!! Form::radio('active', 0, null, [
                'id' => 'deactivate',
                'class' => 'custom-control-input',
                $product->active == 0 ? 'checked' : ''
            ]) !!}
            <label class="custom-control-label" for="deactivate">
                {{ ucfirst('Deactivate') }}
            </label>
        </div>
    </div>
</div>
<div class="form-group border-top pt-3 mb-0">
    <button type="submit" class="btn btn-primary mr-3">
        <i class="far fa-save"></i> {{ __('Save') }}
    </button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-times"></i>
        {{__('Cancel') }}
    </a>
</div>
{!! Form::close() !!}

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <style>
        .upload-cover {
            position: relative;
            margin-top: 5px;
            margin-bottom: 10px;
            float: left;
        }
        .upload-cover input {
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        var index = 1;
        $(document).on('change', '.image-product', function(event) {
            event.preventDefault();
            /* Act on the event */
            let data_key = $(this).attr('data_key');
            let tmppath = URL.createObjectURL(event.target.files[0]);
            let type_file = event.target.files[0].type;
            $('#upload-file-' + data_key + ' .upload-file').css('display', 'none');
            if (type_file.substr(0, 6) === 'image/') {
                $('#upload-file-' + data_key + ' .preview-file').css({
                    'display': 'block'
                });
                $('#upload-file-' + data_key + ' .preview-file img').attr('src', tmppath);
                $('#upload-file-' + data_key + ' .preview-file img').removeClass('d-none');
            } else {
                $('#upload-file-' + data_key + ' .preview-file').css({
                    'background-image': "url('{{ asset('images/icon/images.png') }}')",
                    'display': 'block',
                    'style': 'width: 100px',
                });
            }

            index ++;
            let html =
                '<div id="upload-file-' + index + '" class="col-sm-2 float-left mr-2">' +
                '<div class="upload-file">' +
                '<img src="' + '{{ asset("images/icon/images.png") }}' + '" class="img-fluid" style="width: 100px;">' +
                '<input type="file" name="image_product[]" class="image-product" data_key="' + index + '" multiple>' +
                '</div>' +
                '<div class="preview-file">' +
                '<i class="far fa-trash-alt icon-delete-image" data_key="' + index + '"></i>' +
                '<img src="' + '{{ asset("images/icon/images.png") }}' + '" class="img-fluid d-none" id="img-' + index +'">'+
                '</div>' +
                '</div>';
            $('.list-image').append(html);
        });

        $(document).on('click', '.icon-delete-image', function(event) {
            event.preventDefault();
            /* Act on the event */
            let data_key = $(this).attr('data_key');
            let data_id = $(this).attr('data_id');
            if (data_id) {
                $('.list-file-delete').append('<input type="hidden" name="file_delete[]" value="' + data_id + '"/>');
            }
            $('#upload-file-' + data_key).remove();
        });
    </script>
@endpush
