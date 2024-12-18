@extends('layouts.back-end.app')

@section('title', translate('molecule_Add'))
@push('css_or_js')
    <link href="{{ dynamicAsset(path: 'public/assets/back-end/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/brand.png') }}" alt="">
                {{ translate('molecule_Setup') }}
            </h2>
        </div>

        <div class="row g-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body text-start">
                        <form action="{{ route('admin.molecule.add-new') }}" method="post" enctype="multipart/form-data" class="brand-setup-form">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="title-color">
                                        {{ translate('molecule_Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control" id="name" value=""
                                           placeholder="{{ translate('ex') }} : {{translate('molecule') }}" >
                                </div>
                            </div>
                            <div class="form-group mb-3" id="description">
                                <label for="description" class="title-color text-capitalize">{{ translate('description') }}</label>
                                <textarea class="summernote" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="d-flex gap-3 justify-content-end">
                                <button type="reset" id="reset"
                                        class="btn btn-secondary px-4">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ translate('submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
<script src="{{ dynamicAsset(path: 'public/assets/back-end/plugins/summernote/summernote.min.js') }}"></script>

<script>
$(document).on('ready', function () {
    $('.summernote').summernote({
        'height': 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        callbacks: {
            onChange: function (contents, $editable) {
                if ($(this).hasClass('product-description-default-language')) {
                    var textWithoutTagsAndEntities = contents.replace(/<[^>]+>|&[^;]+;/g, '');
                    var maxLength = 160;
                    if (textWithoutTagsAndEntities.length > maxLength) {
                        textWithoutTagsAndEntities = textWithoutTagsAndEntities.substring(0, maxLength);
                    }
                    $('#meta_description').val(textWithoutTagsAndEntities);
                }
            }
        }
    });

});
</script>
@endpush
