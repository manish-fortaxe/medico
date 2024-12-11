@extends('layouts.back-end.app')

@section('title', translate('department'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/attribute.png') }}" alt="">
                {{ translate('department_Setup') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.department.store') }}" method="post" class="text-start">
                            @csrf

                            <input type="hidden" id="id">
                            <div class="row">
                                <div class="col-6 form-group form-system-language-form">
                                    <label class="title-color" for="name">{{ translate('department_Name') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                            placeholder="{{ translate('enter_Department_Name') }}" >
                                </div>

                                <div class="col-6 form-group form-system-language-form">
                                    <label class="title-color" for="name">{{ translate('sequence') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="sequence">
                                        <option value="">{{ translate('select_department') }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
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
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ translate('department_list') }}
                                    <span
                                        class="badge badge-soft-dark radius-50 fz-12">{{ $departments->total() }}</span>
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
                                               placeholder="{{ translate('search_by_Department_Name') }}"
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
                                    <th class="text-center">{{ translate('department_Name') }} </th>
                                    <th class="text-center">{{ translate('sequence') }} </th>
                                    <th class="text-center">{{ translate('action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $key => $department)
                                    <tr>
                                        <td>{{$departments->firstItem()+$key}}</td>
                                        <td class="text-center">{{ $department['name'] }}</td>
                                        <td class="text-center">{{ $department['sequence'] }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                   title="{{ translate('edit') }}"
                                                   href="{{route('admin.department.update',[$department['id']])}}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm attribute-delete-button square-btn"
                                                   title="{{ translate('delete') }}"
                                                   id="{{ $department['id'] }}">
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
                            {!! $departments->links() !!}
                        </div>
                    </div>

                    @if(count($departments) == 0)
                        @include('layouts.back-end._empty-state',['text'=>'no_attribute_found'],['image'=>'default'])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <span id="route-admin-attribute-delete" data-url="{{ route('admin.department.delete') }}"></span>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/products-management.js') }}"></script>
@endpush
