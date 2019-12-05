@extends("backs.layouts.app")

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>@yield('title')</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">{{ __('Back to list')}}</a>
        </div>
    </div>

    <div class="card ">
        <div class="card-body">
            @include('backs.pages.product.formUpdate',
            ['method' => 'PUT', 'route' => route('admin.products.update', $product->id)])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var num = parseInt('{{ count($product->getMedia('product')) }}');
        $(document).on('click', '#add', function(event){
            num++;
            let html = '<div class="col-sm-3 py-2" id="frame-' + num + '">' +
                '<div class="add-cover-img mb-2 d-block">' +
                '<img src="{{ asset('images/no_image.jpg') }}" class="img-fluid" id="img-' + num + '">' +
                '</div>' +
                '<input type="file" class="input-file" name="product_images[]" data-index="' + num + '" />' +
                '<input type="hidden" class="update-file" name="update[]" value="0" data-index="' + num + '" />' +
                '<div class="btn btn-danger btn-sm icon-delete-slide" data-id="0" data-index="' + num + '">' +
                '<i class="fas fa-times"></i>' +
                '</div>'+
                '</div>';
            $('.image-product').append(html);
        });

        $(document).on('change', '.input-file', function (event) {
            event.preventDefault();
            let data_index = $(this).attr('data-index');
            /* Act on the event */
            let file = event.target.files[0];
            if (file) {
                let url = URL.createObjectURL(file);
                $('#frame-' + data_index + ' img').attr('src', url);
            }
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ mix('css/backs.css') }}">
@endpush
