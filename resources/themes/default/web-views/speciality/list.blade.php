@extends('layouts.front-end.app')

@section('title', translate('super_Speciality'))

@push('css_or_js')
    <meta property="og:image" content="{{ $web_config['web_logo']['path'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <meta property="twitter:card" content="{{ $web_config['web_logo']['path'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <style>
        .for-count-value {
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
            ;
        }

        .for-count-value {

            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
        }

        .for-brand-hover:hover {
            color: var(--web-primary);
        }

        .for-hover-label:hover {
            color: var(--web-primary) !important;
        }

        .page-item.active .page-link {
            background-color: var(--web-primary) !important;
        }

        .for-sorting {
            padding- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 9px;
        }

        .sidepanel {
            {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0;
        }

        .sidepanel .closebtn {
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 25 px;
        }

        @media (max-width: 360px) {
            .for-sorting-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0% !important;
            }

            .for-mobile {

                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 27%;
            }
        }
    </style>
@endpush

@section('content')

    @php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))



    <div class="container pb-5 mb-2 mb-md-4 rtl __inline-35" dir="{{ Session::get('direction') }}">
        <div class="row">
            <aside
                class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters __search-sidebar {{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }}"
                id="SearchParameters">
                <div class="cz-sidebar __inline-35" id="shop-sidebar">
                    <div class="cz-sidebar-header bg-light">
                        <button class="close ms-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                            <i class="tio-clear"></i>
                        </button>
                    </div>

                    <div class="mt-3 __cate-side-arrordion">
                        <div>
                            <div class="text-center __cate-side-title">
                                <span class="widget-title font-semibold">
                                    {{ translate('super_Speciality') }}
                                </span>
                            </div>

                            <div class="accordion mt-n1 __cate-side-price" id="shop-categories">
                                @foreach ($departments as $department)
                                    <div class="menu--caret-accordion">
                                        <div class="card-header flex-between">
                                            <div>
                                                <label class="for-hover-label cursor-pointer get-view-by-onclick"
                                                    data-link="{{ route('speciality', ['type' => $department['slug']]) }}" style="font-size: 20px;">
                                                    {{ $department['name'] }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-overlay"></div>
            </aside>

            <section class="col-lg-9">
                <div class="row" id="ajax-products">
                    @include('web-views.products._ajax-products', [
                        'products' => $products,
                        'decimal_point_settings' => $decimal_point_settings,
                    ])
                </div>
            </section>
        </div>
    </div>



@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/product-view.js') }}"></script>
@endpush
