@extends('layouts.back-end.app')

@section('title', translate('author'))

@section('content')
    <div class="content container-fluid">

        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/attribute.png') }}" class="mb-1 mr-1" alt="">
                {{ translate('update_author') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-10">
                <div class="card">
                    <div class="card-body text-start">
                        <form action="{{route('admin.author.update', [$author['id']])}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-6 form-group form-system-language-form">
                                    <label class="title-color" for="name">{{ translate('name') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $author['name'] }}"
                                            placeholder="{{ translate('enter_Author_Name') }}" >
                                </div>


                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn px-4 btn-secondary">{{ translate('reset') }}</button>
                                <button type="submit" class="btn px-4 btn--primary">{{ translate('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/products-management.js') }}"></script>
@endpush
