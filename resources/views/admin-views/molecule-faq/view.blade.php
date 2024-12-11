@extends('layouts.back-end.app')

@section('title', translate('Molecule_FAQ'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/attribute.png') }}" alt="">
                {{ translate('FAQ_Setup') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.molecule-faq.store') }}" method="post" class="text-start">
                            @csrf

                            <input type="hidden" id="id">
                            <div class="row">
                                <div class="col-3 form-group form-system-language-form" >
                                    <label class="title-color" for="tag_id">{{ translate('molecule') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="tag_id">
                                        <option>{{ translate('select_molecule') }}</option>
                                        @foreach (\App\Models\Tag::get() as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9 form-group form-system-language-form" >
                                    <label class="title-color" for="question">{{ translate('question') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="question" class="form-control" id="question"
                                            placeholder="{{ translate('enter_Question') }}" >
                                </div>

                                <div class="col-12 form-group form-system-language-form" >
                                    <label class="title-color" for="answer">{{ translate('answer') }}<span
                                            class="text-danger">*</span></label>
                                    <textarea name="answer" class="form-control" id="answer" placeholder="{{ translate('enter_Answer') }}"> </textarea>
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
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ translate('faq_list') }}
                                    <span
                                        class="badge badge-soft-dark radius-50 fz-12">{{ $faqs->total() }}</span>
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
                                               placeholder="{{ translate('search_by_Question_Name') }}"
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
                                    <th class="text-center">{{ translate('Question') }} </th>
                                    <th class="text-center">{{ translate('Answer') }} </th>
                                    <th class="text-center">{{ translate('Molecule') }} </th>
                                    <th class="text-center">{{ translate('action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $key => $faq)
                                    <tr>
                                        <td>{{$faqs->firstItem()+$key}}</td>
                                        <td class="text-center">{{ $faq['question'] }}</td>
                                        <td class="text-center">{{ $faq['answer'] }}</td>
                                        <td class="text-center">{{ $faq->tag->tag ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                   title="{{ translate('edit') }}"
                                                   href="{{route('admin.molecule-faq.update',[$faq['id']])}}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm attribute-delete-button square-btn"
                                                   title="{{ translate('delete') }}"
                                                   id="{{ $faq['id'] }}">
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
                            {!! $faqs->links() !!}
                        </div>
                    </div>

                    @if(count($faqs) == 0)
                        @include('layouts.back-end._empty-state',['text'=>'no_attribute_found'],['image'=>'default'])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <span id="route-admin-attribute-delete" data-url="{{ route('admin.attribute.delete') }}"></span>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/products-management.js') }}"></script>
@endpush
