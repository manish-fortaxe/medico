@extends('layouts.back-end.app')

@section('title', translate('Molecule_Update'))
@push('css_or_js')
    <link href="{{ dynamicAsset(path: 'public/assets/back-end/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="content container-fluid">

        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 align-items-center d-flex gap-2">
                <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/brand.png') }}" alt="">
                {{ translate('Molecule_Update') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-start">
                        <form action="{{ route('admin.molecule.update', [$molecule['id']]) }}" method="post"
                              enctype="multipart/form-data" class="brand-setup-form">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="title-color">
                                        {{ translate('tag_Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $molecule->name }}"
                                           placeholder="{{ translate('ex') }} : {{translate('molecule') }}" >
                                </div>
                            </div>
                            <div class="form-group mb-3" id="description">
                                <label for="description" class="title-color text-capitalize">{{ translate('description') }}</label>
                                <textarea class="summernote" name="description">{{ $molecule->description }}</textarea>
                            </div>


                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" id="reset"
                                        class="btn btn-secondary px-4">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ translate('update') }}</button>
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

