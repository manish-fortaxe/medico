@extends('layouts.back-end.app')

@section('title', translate('author'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/attribute.png') }}" alt="">
                {{ translate('author_Setup') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.author.store') }}" method="post" class="text-start" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="id">
                            <div class="row">
                                <div class="col-6 form-group form-system-language-form">
                                    <label class="title-color" for="name">{{ translate('name') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                            placeholder="{{ translate('enter_Author_Name') }}" >
                                </div>
                                <div class="col-6 form-group form-system-language-form">
                                    <label class="title-color" for="degree">{{ translate('degree') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="degree" class="form-control" id="degree"
                                            placeholder="{{ translate('enter_Degree') }}" >
                                </div>


                            </div>
                            <div class="card mb-4 shadow-none">
                                <div class="card-body py-5">
                                    <div class="mx-auto text-center max-w-170px">
                                        <label class="d-block text-center font-weight-bold">
                                            {{translate('image')}}  <small class="text-danger">{{'('.translate('size').': 1:1)'}}</small>
                                        </label>

                                        <label class="custom_upload_input d-block mx-2 cursor-pointer">
                                            <input type="file" name="image" id="brand-image" class="image-input image-preview-before-upload d-none" data-preview="#pre_img_viewer" accept="image/*">

                                            <span class="delete_file_input btn btn-outline-danger btn-sm square-btn d--none">
                                                <i class="tio-delete"></i>
                                            </span>

                                            <div class="img_area_with_preview position-absolute z-index-2 p-0">
                                                <img id="pre_img_viewer" class="h-auto aspect-1 bg-white d-none"
                                                        src="dummy" alt="">
                                            </div>
                                            <div class="placeholder-image">
                                                <div
                                                    class="d-flex flex-column justify-content-center align-items-center aspect-1">
                                                    <img alt="" width="33" src="{{ dynamicAsset(path: 'public/assets/back-end/img/icons/product-upload-icon.svg') }}">
                                                    <h3 class="text-muted fz-12">{{ translate('Upload_Image') }}</h3>
                                                </div>
                                            </div>
                                        </label>

                                        <p class="text-muted mt-2 fz-12 m-0">
                                            {{ translate('image_format') }} : {{ "jpg, png, jpeg" }}
                                            <br>
                                            {{ translate('image_size') }} : {{ translate('max') }} {{ "2 MB" }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ translate('author_list') }}
                                    <span
                                        class="badge badge-soft-dark radius-50 fz-12">{{ $authors->total() }}</span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue"
                                               class="form-control"
                                               placeholder="{{ translate('search_by_Author_Name') }}"
                                               aria-label="Search orders" value="{{ request('searchValue') }}" required>
                                        <button type="submit" class="btn btn--primary">{{ translate('search') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('SL') }}</th>
                                    <th class="text-center">{{ translate('image') }} </th>
                                    <th class="text-center">{{ translate('author_Name') }} </th>
                                    <th class="text-center">{{ translate('degree') }} </th>
                                    <th class="text-center">{{ translate('action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $key => $author)
                                    <tr>
                                        <td>{{$authors->firstItem()+$key}}</td>
                                        <td>
                                            <div class="avatar-60 d-flex align-items-center rounded">
                                                <img class="img-fluid" alt=""
                                                     src="{{ getStorageImages(path:$author->image_full_url, type: 'author') }}">
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $author['name'] }}</td>
                                        <td class="text-center">{{ $author['degree'] }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                   title="{{ translate('edit') }}"
                                                   href="{{route('admin.author.update',[$author['id']])}}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm attribute-delete-button square-btn"
                                                   title="{{ translate('delete') }}"
                                                   id="{{ $author['id'] }}">
                                                    <i class="tio-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $authors->links() !!}
                        </div>
                    </div>

                    @if(count($authors) == 0)
                        @include('layouts.back-end._empty-state',['text'=>'no_author_found'],['image'=>'default'])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <span id="route-admin-attribute-delete" data-url="{{ route('admin.author.delete') }}"></span>
@endsection

@push('script')
<script>
    $('.brand-setup-form').on('reset', function () {
        $(this).find('#pre_img_viewer').addClass('d-none');
        $(this).find('.placeholder-image').css('opacity', '1');
    });
</script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/products-management.js') }}"></script>
@endpush
