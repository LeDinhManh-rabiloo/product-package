{!! Form::open(['url' => [$route], 'method' => $method, 'files' => true]) !!}
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
            <div id="upload-file-1" class="col-sm-2 float-left mr-2">
                <div class="upload-file">
                    <img src="{{ asset('images/icon/images.png') }}" class="img-fluid" style="width: 100px;">
                    <input type="file" name="image_product[]" class="image-product" data_key="1" multiple>
                </div>
                <div class="preview-file mt-1">
                    <i class="far fa-trash-alt icon-delete-image" data_key="1"></i>
                    <img src="{{ asset('images/icon/images.png') }}" class="img-fluid d-none" id="img-1">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tab panes -->
<div class="form-group">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', null, ['class' => "form-control", 'name' => "name" ]) }}
</div>
<div class="form-group">
    {{ Form::label('price', __('Price')) }}
    {{ Form::number('price', null, ['class' => "form-control", 'name' => "price" ]) }}
</div>

<div class="form-group">
    {{ Form::label('quantity', __('Quantity')) }}
    {{ Form::number('qty', $product->quantity ?? null, ['name' => "qty", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('category', __('Category')) }}
    {{ Form::select('cate_product_id', $category ?? null, 1,
    ['id' => "category", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('url_key', __('Url key')) }}
    {{ Form::text('url_key', $product->url_key ?? null,['name' => "url_key", 'class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('meta_title', __('Meta title')) }}
    {{ Form::textarea('meta_title', $product->meta_title ?? null, ['name' => "meta_title", 'class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('meta_description', __('Meta description')) }}
    {{ Form::textarea('meta_description', $product->meta_description ?? null, ['name' => "meta_description_en", 'class' => "form-control"]) }}
</div>
<div class="form-group">
    {{ Form::label('short_description', __('Short description')) }}
    {{ Form::textarea('short_description', $product->short_description ?? null, ['name' => "short_description", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {{ Form::label('description', __('Description')) }}
    {{ Form::textarea('description', $product->description ?? null, ['name' => "description", 'class' => "form-control"]) }}
</div>

<div class="form-group">
    {!! Form::label('select_activate ', __('Select Activate')) !!}
    <div class="ml-2 ml-md-4">
        <div class="custom-control custom-checkbox custom-control-inline">
            {!! Form::radio('active', 1, null, [
                'id' => 'activate',
                'class' => 'custom-control-input',
            ]) !!}
            <label class="custom-control-label" for="activate">
                {{ ucfirst('Activate') }}
            </label>
        </div>
        <div class="custom-control custom-checkbox custom-control-inline">
            {!! Form::radio('active', 0, null, [
                'id' => 'deactivate',
                'class' => 'custom-control-input',
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
            $('#upload-file-' + data_key).remove();
        });
    </script>
@endpush
