@extends('layouts.front-end.app')

@section('title', $web_config['name']->value . ' ' . translate('online_Shopping') . ' | ' . $web_config['name']->value .
    ' ' . translate('ecommerce'))

    @push('css_or_js')
        <meta property="og:image" content="{{ $web_config['web_logo']['path'] }}" />
        <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="og:url" content="{{ env('APP_URL') }}">
        <meta property="og:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <meta property="twitter:card" content="{{ $web_config['web_logo']['path'] }}" />
        <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="twitter:url" content="{{ env('APP_URL') }}">
        <meta property="twitter:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/home.css') }}" />
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.theme.default.min.css') }}">
        <style>
            .carousel1 .carousel-item {
                color: #999;
                overflow: hidden;
                min-height: 120px;
                font-size: 13px;
            }

            .carousel1 .media img {
                width: 80px;
                height: 80px;
                display: block;
                border-radius: 50%;
            }

            .carousel1 .testimonial {
                padding: 0 15px 0 60px;
                position: relative;
            }

            .carousel1 .testimonial::before {
                content: "\201C";
                font-family: Arial, sans-serif;
                color: #e2e2e2;
                font-weight: bold;
                font-size: 68px;
                line-height: 54px;
                position: absolute;
                left: 15px;
                top: 0;
            }

            .carousel1 .overview b {
                text-transform: uppercase;
                color: #1c47e3;
            }

            .carousel1 .carousel-indicators {
                bottom: -40px;
            }

            .carousel-indicators li,
            .carousel-indicators li.active {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                margin: 1px 3px;
                box-sizing: border-box;
            }

            .carousel-indicators li {
                background: #e2e2e2;
                border: 4px solid #fff;
            }

            .carousel-indicators li.active {
                color: #fff;
                background: #1c47e3;
                border: 5px double;
            }

            /* Second testimonial */
            .carousel {
                margin: 50px auto;
            }

            .carousel .carousel-item {
                color: #999;
                overflow: hidden;
                min-height: 120px;
                font-size: 13px;
            }

            .carousel .media {
                position: relative;
                padding: 0 0 0 20px;
                margin-left: 20px;
            }

            .carousel .media img {
                width: 75px;
                height: 75px;
                display: block;
                border-radius: 50%;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 2px solid #fff;
            }

            .carousel .testimonial {
                color: #fff;
                position: relative;
                background: #9b9b9b;
                padding: 15px;
                margin: 0 0 20px 20px;
            }

            .carousel .testimonial::before,
            .carousel .testimonial::after {
                content: "";
                display: inline-block;
                position: absolute;
                left: 0;
                bottom: -20px;
            }

            .carousel .testimonial::before {
                width: 20px;
                height: 20px;
                background: #9b9b9b;
                box-shadow: inset 12px 0 13px rgba(0, 0, 0, 0.5);
            }

            .carousel .testimonial::after {
                width: 0;
                height: 0;
                border: 10px solid transparent;
                border-bottom-color: #fff;
                border-left-color: #fff;
            }

            .carousel .carousel-item .row>div:first-child .testimonial {
                margin: 0 20px 20px 0;
            }

            .carousel .carousel-item .row>div:first-child .media {
                margin-left: 0;
            }

            .carousel .testimonial p {
                text-indent: 40px;
                line-height: 21px;
                margin: 0;
            }

            .carousel .testimonial p::before {
                content: "\201D";
                font-family: Arial, sans-serif;
                color: #fff;
                font-weight: bold;
                font-size: 68px;
                line-height: 70px;
                position: absolute;
                left: -25px;
                top: 0;
            }

            .carousel .overview {
                padding: 3px 0 0 15px;
            }

            .carousel .overview .details {
                padding: 5px 0 8px;
            }

            .carousel .overview b {
                text-transform: uppercase;
                color: #ff5555;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 30px;
                height: 30px;
                background: #666;
                text-shadow: none;
                top: 4px;
            }

            .carousel-control-prev i,
            .carousel-control-next i {
                font-size: 16px;
            }

            .carousel-control-prev {
                left: auto;
                right: 40px;
            }

            .carousel-control-next {
                left: auto;
            }

            .carousel-indicators {
                bottom: -80px;
            }

            .carousel-indicators li,
            .carousel-indicators li.active {
                width: 17px;
                height: 17px;
                border-radius: 0;
                margin: 1px 5px;
                box-sizing: border-box;
            }

            .carousel-indicators li {
                background: #e2e2e2;
                border: 4px solid #fff;
            }

            .carousel-indicators li.active {
                color: #fff;
                background: #ff5555;
                border: 5px double;
            }

            .star-rating li {
                padding: 0 2px;
            }

            .star-rating i {
                font-size: 14px;
                color: #ffdc12;
            }

            .product-grid {
                font-family: "Fraunces", serif;
                text-align: center;
                border-radius: 10px 10px;
                padding: 10px 10px;
                border: 1px solid #F3D2E0;
                overflow: hidden;
                margin: 0 auto;
            }

            .product-grid .product-image {
                border-radius: 10px 10px;
                overflow: hidden;
                position: relative;
                border: 1px solid #F3D2E0;
            }

            .product-grid .product-image a.image {
                display: block;
            }

            .product-grid .product-image img {
                width: 100%;
                height: auto;
            }

            .product-image .pic-1 {
                opacity: 1;
                backface-visibility: hidden;
                transition: all 0.4s ease-out 0s;
            }

            .product-image .pic-2 {
                width: 100%;
                height: 100%;
                opacity: 0;
                backface-visibility: hidden;
                transform: scale(3);
                position: absolute;
                top: 0;
                left: 0;
                transition: all 0.4s ease-out 0s;
            }

            .product-grid .product-new-label,
            .product-grid .product-sale-label {
                color: #fff;
                background: #812143;
                font-size: 13px;
                font-weight: 400;
                padding: 3px 9px;
                text-transform: uppercase;
                border-radius: 5px 5px;
                opacity: 1;
                position: absolute;
                top: 12px;
                right: 12px;
                transition: all 0.3s ease-in-out;
            }

            .product-grid:hover .product-new-label,
            .product-grid:hover .product-sale-label {
                opacity: 0;
            }

            .product-grid .product-links {
                padding: 0;
                margin: 0;
                list-style: none;
                opacity: 0;
                position: absolute;
                top: 10px;
                right: 10px;
                transition: all .3s ease 0.3s;
            }

            .product-grid:hover .product-links {
                opacity: 1;
            }

            .product-grid .product-links li {
                margin: 0 0 5px;
                display: block;
            }

            .product-grid .product-links li:last-child {
                margin: 0;
            }

            .product-grid .product-links li a {
                color: #aaa;
                background-color: #fff;
                font-size: 16px;
                font-weight: 600;
                line-height: 40px;
                height: 40px;
                width: 40px;
                border-radius: 50%;
                margin: 0;
                display: block;
                position: relative;
                transition: all 0.3s ease 0.1s;
            }

            .product-grid .product-links li a:hover {
                color: #fff;
                background-color: #812143;
                border-color: #812143;
            }

            .product-grid .product-links li a i {
                line-height: inherit;
            }

            .product-grid .product-links li a:before,
            .product-grid .product-links li a:after {
                content: attr(data-tip);
                color: #fff;
                background: #812143;
                font-size: 12px;
                line-height: 20px;
                padding: 5px 10px;
                white-space: nowrap;
                display: none;
                border-radius: 5px 5px;
                transform: translateY(-50%);
                position: absolute;
                right: 53px;
                top: 50%;
                z-index: 1;
            }

            .product-grid .product-links li a:after {
                content: "";
                height: 15px;
                width: 15px;
                padding: 0;
                border-radius: 0;
                transform: translateY(-50%) rotate(45deg);
                right: 50px;
                z-index: 0;
            }

            .product-grid .product-links li a:hover:before,
            .product-grid .product-links li a:hover:after {
                display: block;
            }

            .product-grid .add-cart {
                color: #fff;
                background: #812143;
                font-size: 14px;
                font-weight: 500;
                letter-spacing: 1px;
                opacity: 0;
                text-transform: uppercase;
                padding: 11px 12px 10px;
                display: block;
                transition: all .3s ease;
            }

            .product-grid .add-cart i {
                margin: 0 5px 0 0;
            }

            .product-grid:hover .add-cart {
                opacity: 1;
            }

            .product-grid .product-content {
                padding: 10px 0 0;
            }

            .product-grid .product-category {
                font-size: 14px;
                text-transform: uppercase;
                margin-bottom: 5px;
                display: block;
            }

            .product-grid .product-category a {
                color: #812143;
                transition: all .4s ease 0s;
            }

            .product-grid .title {
                font-size: 17px;
                font-weight: 600;
                text-transform: uppercase;
                margin: 0 0 5px;
            }

            .product-grid .title a {
                color: #000;
                transition: all 0.3s ease 0s;
            }

            .product-grid .title a:hover {
                color: #812143;
            }

            .product-grid .price {
                color: #812143;
                font-size: 20px;
                font-weight: 400;
                margin: 0 0 5px;
            }

            @media screen and (max-width: 990px) {
                .product-grid {
                    margin-bottom: 30px;
                }
            }

            .counter {
                color: #009CB5;
                background: #009CB5;
                font-family: 'Hind', sans-serif;
                text-align: center;
                width: 200px;
                height: 200px;
                padding: 70px 10px 25px 25px;
                margin: 50px auto 0;
                border-radius: 50%;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
                position: relative;
                z-index: 1;
            }

            .counter:after {
                content: '';
                background-color: #fff;
                width: calc(100% - 20px);
                height: calc(100% - 20px);
                border-radius: 0 50%;
                position: absolute;
                top: 0;
                right: 0;
                box-shadow: -10px 10px 10px rgba(0, 0, 0, 0.3);
                z-index: -1;
            }

            .counter .counter-icon {
                color: #fff;
                background: #009CB5;
                font-size: 45px;
                width: 80px;
                height: 80px;
                line-height: 80px;
                border-radius: 0 30px;
                transform: translateX(-50%);
                position: absolute;
                top: -30px;
                left: 50%;
                transition: all 0.3s ease 0s;
            }

            .counter .counter-icon i {
                line-height: inherit;
            }

            .counter h3 {
                color: var(--main-color);
                font-size: 19px;
                font-weight: 600;
                text-transform: capitalize;
                margin: 0 0 15px;
            }

            .counter .counter-value {
                color: var(--main-color);
                font-size: 30px;
                font-weight: 700;
                line-height: 30px;
                display: inline-block;
            }

            .counter.yellow {
                --color: #F1931A;
            }

            .counter.green {
                --color: #009432;
            }

            .counter.red {
                --color: #E44A3D;
            }

            @media screen and (max-width:990px) {
                .counter {
                    margin-bottom: 40px;
                }
            }
        </style>
    @endpush

@section('content')
    <div class="__inline-61">
        @php($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0)

        @include('web-views.partials._home-top-slider', ['main_banner' => $main_banner])

        @if ($flashDeal['flashDeal'] && $flashDeal['flashDealProducts'])
            @include('web-views.partials._flash-deal', ['decimal_point_settings' => $decimalPointSettings])
        @endif

        @include('web-views.partials._category-section-home')

        @if ($featuredProductsList->count() > 0)
            <div class="container py-4 rtl px-0 px-md-3">
                <div class="__inline-62 pt-3">
                    <div class="feature-product-title mt-0 web-text-primary">
                        {{ translate('featured_products') }}
                    </div>
                    <div class="text-end px-3 d-none d-md-block">
                        <a class="text-capitalize view-all-text web-text-primary"
                            href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                            {{ translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                        </a>
                    </div>
                    <div class="feature-product">
                        <div class="carousel-wrap p-1">
                            <div class="owl-carousel owl-theme" id="featured_products_list">
                                @foreach ($featuredProductsList as $product)
                                    <div>
                                        @include('web-views.partials._feature-product', [
                                            'product' => $product,
                                            'decimal_point_settings' => $decimalPointSettings,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center pt-2 d-md-none">
                            <a class="text-capitalize view-all-text web-text-primary"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                                {{ translate('view_all') }}
                                <i
                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($web_config['featured_deals'] && count($web_config['featured_deals']) > 0)
            <section class="featured_deal">
                <div class="container">
                    <div class="__featured-deal-wrap bg--light">
                        <div class="d-flex flex-wrap justify-content-between gap-8 mb-3">
                            <div class="w-0 flex-grow-1">
                                <span
                                    class="featured_deal_title font-bold text-dark">{{ translate('featured_deal') }}</span>
                                <br>
                                <span
                                    class="text-left text-nowrap">{{ translate('see_the_latest_deals_and_exciting_new_offers') }}!</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary"
                                    href="{{ route('products', ['data_from' => 'featured_deal']) }}">
                                    {{ translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme new-arrivals-product">
                            @foreach ($web_config['featured_deals'] as $key => $product)
                                @include('web-views.partials._product-card-1', [
                                    'product' => $product,
                                    'decimal_point_settings' => $decimalPointSettings,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if (isset($main_section_banner))
            <div class="container rtl pt-4 px-0 px-md-3">
                <a href="{{ $main_section_banner->url }}" target="_blank" class="cursor-pointer d-block">
                    <img class="d-block footer_banner_img __inline-63" alt=""
                        src="{{ getStorageImages(path: $main_section_banner->photo_full_url, type: 'wide-banner') }}">
                </a>
            </div>
        @endif

        @php($businessMode = getWebConfig(name: 'business_mode'))
        @if ($businessMode == 'multi' && count($topVendorsList) > 0)
            @include('web-views.partials._top-sellers')
        @endif

        @include('web-views.partials._deal-of-the-day', [
            'decimal_point_settings' => $decimalPointSettings,
        ])


        @if (count($footer_banner) > 1)
            <div class="container rtl pt-4">
                <div class="promotional-banner-slider owl-carousel owl-theme">
                    @foreach ($footer_banner as $banner)
                        <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                            <img class="footer_banner_img __inline-63" alt=""
                                src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}">
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container rtl pt-4">
                <div class="row">
                    @foreach ($footer_banner as $banner)
                        <div class="col-md-6">
                            <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                <img class="footer_banner_img __inline-63" alt=""
                                    src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($homeCategories->count() > 0)
            @foreach ($homeCategories as $category)
                @include('web-views.partials._category-wise-product', [
                    'decimal_point_settings' => $decimalPointSettings,
                ])
            @endforeach
        @endif


        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <h2>Why Our Customers Love Us?</b></h2>
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor,
                                                varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel,
                                                semper malesuada ante.</p>
                                        </div>
                                        <div class="media">
                                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjUMUSbIykBAuoFvyfd-oB5bO4EhjeDILEwi7Cwuk4yQp0524C-4=s120-c-rp-mo-ba5-br100" class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Paula Wilson</b></div>
                                                    <div class="details">Media Analyst / SkyNet</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt.
                                                Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat
                                                faucibus quam.</p>
                                        </div>
                                        <div class="media">
                                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjWanyEGEznM3Ue_1P-hjVCVPsAcTdvhNopNKYxOaHXVzLWS5Fp7=s120-c-rp-mo-br100" class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Antonio Moreno</b></div>
                                                    <div class="details">Web Developer / SoftBee</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor,
                                                varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel,
                                                semper malesuada ante.</p>
                                        </div>
                                        <div class="media">
                                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjWanyEGEznM3Ue_1P-hjVCVPsAcTdvhNopNKYxOaHXVzLWS5Fp7=s120-c-rp-mo-br100" class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Michael Holz</b></div>
                                                    <div class="details">Web Developer / DevCorp</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt.
                                                Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat
                                                faucibus quam.</p>
                                        </div>
                                        <div class="media">
                                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjUMUSbIykBAuoFvyfd-oB5bO4EhjeDILEwi7Cwuk4yQp0524C-4=s120-c-rp-mo-ba5-br100" class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Mary Saveley</b></div>
                                                    <div class="details">Graphic Designer / MarsMedia</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor,
                                                varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel,
                                                semper malesuada ante.</p>
                                        </div>
                                        <div class="media">
                                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjUMUSbIykBAuoFvyfd-oB5bO4EhjeDILEwi7Cwuk4yQp0524C-4=s120-c-rp-mo-ba5-br100" class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Martin Sommer</b></div>
                                                    <div class="details">SEO Analyst / RealSearch</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt.
                                                Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat
                                                faucibus quam.</p>
                                        </div>
                                        <div class="media">
                                            <div class="media-left d-flex mr-3">
                                                <img src="https://lh3.googleusercontent.com/a/ACg8ocJ-4X4XI18GjHXHUgGKk8PCe9VT28-ySb6-x8_4fJqSfEGi-w=s120-c-rp-mo-br100" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>John Williams</b></div>
                                                    <div class="details">Web Designer / UniqueDesign</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3 mb-3">
            <div class="row text-center">
                <h1>What We Do?</h1>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#" class="image">
                                <img class="pic-1"
                                    src="https://www.mrmed.in/_next/image?url=%2Fhome%2FPAP.jpg&w=828&q=75">
                            </a>
                        </div>
                        <div class="product-content">
                            <h3 class="title">Patient Assistance Programme</h3>
                            <div class="price">50.00$ – 200.00$</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#" class="image">
                                <img class="pic-1"
                                    src="https://www.mrmed.in/_next/image?url=%2Fhome%2Fimport-med.png&w=828&q=75">
                            </a>
                        </div>
                        <div class="product-content">
                            <h3 class="title">Patient Assistance Programme</h3>
                            <div class="price">50.00$ – 200.00$</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#" class="image">
                                <img class="pic-1"
                                    src="https://www.mrmed.in/_next/image?url=%2Fhome%2Fcold-chain.png&w=828&q=75">
                            </a>
                        </div>
                        <div class="product-content">
                            <h3 class="title">Patient Assistance Programme</h3>
                            <div class="price">50.00$ – 200.00$</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <div class="counter-icon">
                            <span><i class="fa fa-globe"></i></span>
                        </div>
                        <h3>Products</h3>
                        <span class="counter-value">1963</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter red">
                        <div class="counter-icon">
                            <span><i class="fa fa-rocket"></i></span>
                        </div>
                        <h3>Years of Exp.</h3>
                        <span class="counter-value">2056</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter green">
                        <div class="counter-icon">
                            <span><i class="fa fa-user"></i></span>
                        </div>
                        <h3>Specialities</h3>
                        <span class="counter-value">1756</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter yellow">
                        <div class="counter-icon">
                            <span><i class="fa fa-briefcase"></i></span>
                        </div>
                        <h3>Orders</h3>
                        <span class="counter-value">1823</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($blogs->count() > 0)
            <div class="container-fluid ">
                <div class="d-flex featuredproductwithbtn align-items-center">
                    <div class="feature-product-title">
                        <h3 class="m-0 color-black">{{ translate('latest_blogs') }}</h3>
                    </div>
                    <div class="viewallbtn ml-auto">
                        <a class="text-capitalize view-all-text" href="{{ route('blogs', ['page' => 1]) }}">
                            {{ translate('view_more') }}
                        </a>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            @include('web-views.partials._inline-single-blog', ['blog' => $blog])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="mb-5">Testimonials</h2>

                    <div id="myCarousel" class="carousel1 slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem
                                                        scelerisque tempor, varius quam luctus dui. Mauris magna metus nec.
                                                    </p>
                                                    <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget
                                                        mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                                    <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem
                                                        scelerisque tempor, varius quam luctus dui. Mauris magna metus nec.
                                                    </p>
                                                    <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget
                                                        mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                                    <p class="overview"><b>Mary Saveley</b>, Web Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem
                                                        scelerisque tempor, varius quam luctus dui. Mauris magna metus nec.
                                                    </p>
                                                    <p class="overview"><b>Martin Sommer</b>, UX Analyst</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <img src="https://www.tutorialrepublic.com/examples/images/clients/3.jpg"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="testimonial">
                                                    <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget
                                                        mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                                    <p class="overview"><b>John Williams</b>, Web Developer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <span id="direction-from-session" data-value="{{ session()->get('direction') }}"></span>
@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/home.js') }}"></script>
    <script>
        window.onload = function() {
            $('.counter-value').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3500,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }
    </script>
@endpush
