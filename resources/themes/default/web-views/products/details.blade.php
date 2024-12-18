@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    @include(VIEW_FILE_NAMES['product_seo_meta_content_partials'], ['metaContentData' => $product?->seoInfo, 'product' => $product])
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/product-details.css') }}"/>
@endpush

@section('content')
    <div class="__inline-23">
        <div class="container mt-4 rtl text-align-direction">
            <div class="row {{Session::get('direction') === "rtl" ? '__dir-rtl' : ''}}">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="cz-product-gallery">
                                <div class="cz-preview">
                                    <div id="sync1" class="owl-carousel owl-theme product-thumbnail-slider">
                                        @if($product->images!=null && json_decode($product->images)>0)
                                            @if(json_decode($product->colors) && count($product->color_images_full_url)>0)
                                                @foreach ($product->color_images_full_url as $key => $photo)
                                                    @if($photo['color'] != null)
                                                        <div
                                                            class="product-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                            id="image{{$photo['color']}}">
                                                            <img class="cz-image-zoom img-responsive w-100"
                                                                 src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                                                 data-zoom="{{ getStorageImages(path: $photo['image_name'], type: 'product')  }}"
                                                                 alt="{{ translate('product') }}" width="">
                                                            <div class="cz-image-zoom-pane"></div>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="product-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                            id="image{{$key}}">
                                                            <img class="cz-image-zoom img-responsive w-100"
                                                                 src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                                                 data-zoom="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                                                 alt="{{ translate('product') }}" width="">
                                                            <div class="cz-image-zoom-pane"></div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($product->images_full_url as $key => $photo)
                                                    <div
                                                        class="product-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                        id="image{{$key}}">
                                                        <img class="cz-image-zoom img-responsive w-100"
                                                             src="{{ getStorageImages($photo, type: 'product') }}"
                                                             data-zoom="{{ getStorageImages(path: $photo, type: 'product') }}"
                                                             alt="{{ translate('product') }}" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex flex-column gap-3">
                                    <button type="button" data-product-id="{{$product['id']}}"
                                            class="btn __text-18px border wishList-pos-btn d-sm-none product-action-add-wishlist">
                                        <i class="fa {{($wishlistStatus == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}} web-text-primary"
                                           aria-hidden="true"></i>
                                        <div class="wishlist-tooltip" x-placement="top">
                                            <div class="arrow"></div><div class="inner">
                                                <span class="add">{{translate('added_to_wishlist')}}</span>
                                                <span class="remove">{{translate('removed_from_wishlist')}}</span>
                                            </div>
                                        </div>
                                    </button>

                                    <div class="sharethis-inline-share-buttons share--icons text-align-direction">
                                    </div>
                                </div>

                                <div class="cz">
                                    <div class="table-responsive __max-h-515px" data-simplebar>
                                        <div class="d-flex">
                                            <div id="sync2" class="owl-carousel owl-theme product-thumb-slider">
                                                @if($product->images!=null && json_decode($product->images)>0)
                                                    @if(json_decode($product->colors) && count($product->color_images_full_url)>0)
                                                        @foreach ($product->color_images_full_url as $key => $photo)
                                                            @if($photo['color'] != null)
                                                                <div class="">
                                                                    <a class="product-preview-thumb color-variants-preview-box-{{ $photo['color'] }} {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                       id="preview-img{{$photo['color']}}"
                                                                       href="#image{{$photo['color']}}">
                                                                        <img alt="{{ translate('product') }}"
                                                                             src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}">
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <a class="product-preview-thumb {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                       id="preview-img{{$key}}" href="#image{{$key}}">
                                                                        <img alt="{{ translate('product') }}"
                                                                             src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}">
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($product->images_full_url as $key => $photo)
                                                            <div class="">
                                                                <a class="product-preview-thumb {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                   id="preview-img{{$key}}" href="#image{{$key}}">
                                                                    <img alt="{{ translate('product') }}"
                                                                         src="{{ getStorageImages(path: $photo, type: 'product') }}">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3 web-direction">
                            <div class="details __h-100">
                                <span class="mb-2 __inline-24">{{$product->name}}</span>
                                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                    <div class="star-rating me-2">
                                        @for($inc=1;$inc<=5;$inc++)
                                            @if ($inc <= (int)$overallRating[0])
                                                <i class="tio-star text-warning"></i>
                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                <i class="tio-star-half text-warning"></i>
                                            @else
                                                <i class="tio-star-outlined text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span
                                        class="d-inline-block  align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'}} fs-14 text-muted">({{$overallRating[0]}})</span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span class="web-text-primary">{{$overallRating[1]}}</span> {{translate('reviews')}}</span>
                                    <span class="__inline-25"></span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span class="web-text-primary">{{$countOrder}}</span> {{translate('orders')}}   </span>
                                    <span class="__inline-25">    </span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}} text-capitalize"> <span class="web-text-primary countWishlist-{{ $product->id }}"> {{$countWishlist}}</span> {{translate('wish_listed')}} </span>

                                </div>
                                <div class="mb-3">
                                    <span class="font-weight-normal text-accent d-flex align-items-end gap-2">
                                        {!! getPriceRangeWithDiscount(product: $product) !!}
                                    </span>
                                </div>

                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div
                                        class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-2">
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="flex-start align-items-center mb-2">
                                                <div
                                                    class="product-description-label m-0 text-dark font-bold">{{translate('color')}}
                                                    :
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-0 flex-start ms-2 ps-0">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <li>
                                                                <input type="radio"
                                                                       id="{{ str_replace(' ', '', ($product->id. '-color-'. str_replace('#','',$color))) }}"
                                                                       name="color" value="{{ $color }}"
                                                                       @if($key == 0) checked @endif>
                                                                <label style="background: {{ $color }};"
                                                                    class="focus-preview-image-by-color shadow-border"
                                                                    for="{{ str_replace(' ', '', ($product->id. '-color-'. str_replace('#','',$color))) }}"
                                                                    data-toggle="tooltip"
                                                                    data-key="{{ str_replace('#','',$color) }}"
                                                                   data-colorid="preview-box-{{ str_replace('#','',$color) }}" data-title="{{ \App\Utils\get_color_name($color) }}">
                                                                    <span class="outline"></span></label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $qty = 0;
                                            if(!empty($product->variation)){
                                            foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        @endphp
                                    </div>

                                    @php($extensionIndex=0)
                                    @if($product['product_type'] == 'digital' && $product['digital_product_file_types'] && count($product['digital_product_file_types']) > 0 && $product['digital_product_extensions'])
                                        @foreach($product['digital_product_extensions'] as $extensionKey => $extensionGroup)
                                        <div class="row flex-start mx-0 align-items-center mb-1">
                                            <div class="product-description-label text-dark font-bold {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}} text-capitalize mb-2">
                                                {{ translate($extensionKey) }} :
                                            </div>
                                            <div>
                                                @if(count($extensionGroup) > 0)
                                                <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row ps-0">
                                                    @foreach($extensionGroup as $index => $extension)
                                                    <div>
                                                        <div class="for-mobile-capacity">
                                                            <input type="radio" hidden
                                                                   id="extension_{{ str_replace(' ', '-', $extension) }}"
                                                                   name="variant_key"
                                                                   value="{{ $extensionKey.'-'.preg_replace('/\s+/', '-', $extension) }}"
                                                                {{ $extensionIndex == 0 ? 'checked' : ''}}>
                                                            <label for="extension_{{ str_replace(' ', '-', $extension) }}"
                                                                   class="__text-12px">
                                                                {{ $extension }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @php($extensionIndex++)
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif

                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row flex-start mx-0 align-items-center">
                                            <div
                                                class="product-description-label text-dark font-bold {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}} text-capitalize mb-2">{{ $choice->title }}
                                                :
                                            </div>
                                            <div>
                                                <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row ps-0">
                                                    @foreach ($choice->options as $index => $option)
                                                        <div>
                                                            <div class="for-mobile-capacity">
                                                                <input type="radio"
                                                                       id="{{ str_replace(' ', '', ($choice->name. '-'. $option)) }}"
                                                                       name="{{ $choice->name }}" value="{{ $option }}"
                                                                       @if($index == 0) checked @endif >
                                                                <label class="__text-12px"
                                                                       for="{{ str_replace(' ', '', ($choice->name. '-'. $option)) }}"">{{ $option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mt-3">

                                        <div class="mb-2">
                                            @if($product?->is_prescription == 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path d="M301.3 352l78.1-78.1c6.3-6.3 6.3-16.4 0-22.6l-22.6-22.6c-6.3-6.3-16.4-6.3-22.6 0L256 306.7l-84-84C219.3 216.8 256 176.9 256 128c0-53-43-96-96-96H16C7.2 32 0 39.2 0 48v256c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-80h18.8l128 128-78.1 78.1c-6.3 6.3-6.3 16.4 0 22.6l22.6 22.6c6.3 6.3 16.4 6.3 22.6 0L256 397.3l78.1 78.1c6.3 6.3 16.4 6.3 22.6 0l22.6-22.6c6.3-6.3 6.3-16.4 0-22.6L301.3 352zM64 96h96c17.6 0 32 14.4 32 32s-14.4 32-32 32H64V96z"/></svg>
                                            @endisset

                                            @if($product?->cold_chain)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path d="M440.3 345.2l-33.8-19.5 26-7c8.2-2.2 13.1-10.7 10.9-18.9l-4-14.9c-2.2-8.2-10.7-13.1-18.9-10.9l-70.8 19-63.9-37 63.8-36.9 70.8 19c8.2 2.2 16.7-2.7 18.9-10.9l4-14.9c2.2-8.2-2.7-16.7-10.9-18.9l-26-7 33.8-19.5c7.4-4.3 9.9-13.7 5.7-21.1L430.4 119c-4.3-7.4-13.7-9.9-21.1-5.7l-33.8 19.5 7-26c2.2-8.2-2.7-16.7-10.9-18.9l-14.9-4c-8.2-2.2-16.7 2.7-18.9 10.9l-19 70.8-62.8 36.2v-77.5l53.7-53.7c6.2-6.2 6.2-16.4 0-22.6l-11.3-11.3c-6.2-6.2-16.4-6.2-22.6 0L256 56.4V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v40.4l-19.7-19.7c-6.2-6.2-16.4-6.2-22.6 0L138.3 48c-6.3 6.2-6.3 16.4 0 22.6l53.7 53.7v77.5l-62.8-36.2-19-70.8c-2.2-8.2-10.7-13.1-18.9-10.9l-14.9 4c-8.2 2.2-13.1 10.7-10.9 18.9l7 26-33.8-19.5c-7.4-4.3-16.8-1.7-21.1 5.7L2.1 145.7c-4.3 7.4-1.7 16.8 5.7 21.1l33.8 19.5-26 7c-8.3 2.2-13.2 10.7-11 19l4 14.9c2.2 8.2 10.7 13.1 18.9 10.9l70.8-19 63.8 36.9-63.8 36.9-70.8-19c-8.2-2.2-16.7 2.7-18.9 10.9l-4 14.9c-2.2 8.2 2.7 16.7 10.9 18.9l26 7-33.8 19.6c-7.4 4.3-9.9 13.7-5.7 21.1l15.5 26.8c4.3 7.4 13.7 9.9 21.1 5.7l33.8-19.5-7 26c-2.2 8.2 2.7 16.7 10.9 18.9l14.9 4c8.2 2.2 16.7-2.7 18.9-10.9l19-70.8 62.8-36.2v77.5l-53.7 53.7c-6.3 6.2-6.3 16.4 0 22.6l11.3 11.3c6.2 6.2 16.4 6.2 22.6 0l19.7-19.7V496c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-40.4l19.7 19.7c6.2 6.2 16.4 6.2 22.6 0l11.3-11.3c6.2-6.2 6.2-16.4 0-22.6L256 387.7v-77.5l62.8 36.2 19 70.8c2.2 8.2 10.7 13.1 18.9 10.9l14.9-4c8.2-2.2 13.1-10.7 10.9-18.9l-7-26 33.8 19.5c7.4 4.3 16.8 1.7 21.1-5.7l15.5-26.8c4.3-7.3 1.8-16.8-5.6-21z"/></svg>
                                            @endisset

                                            @if($product?->pap_description)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px;"><path d="M277.4 12C261.1 4.5 243.1 0 224 0c-53.7 0-99.5 33.1-118.5 80h81.2l90.7-68zM342.5 80c-7.9-19.5-20.7-36.2-36.5-49.5L240 80h102.5zM224 256c70.7 0 128-57.3 128-128 0-5.5-1-10.7-1.6-16H97.6c-.7 5.3-1.6 10.5-1.6 16 0 70.7 57.3 128 128 128zM80 299.7V512h128.3l-98.5-221.5A132.8 132.8 0 0 0 80 299.7zM0 464c0 26.5 21.5 48 48 48V320.2C18.9 344.9 0 381.3 0 422.4V464zm256-48h-55.4l42.7 96H256c26.5 0 48-21.5 48-48s-21.5-48-48-48zm57.6-128h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.7-5.8-72.9-16h-7.4l42.7 96H256c44.1 0 80 35.9 80 80 0 18.1-6.3 34.6-16.4 48H400c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                                            @endisset

                                        </div>

                                        @isset($product->tags)
                                        <p><b>Salt Composition :</b> {!! salt_composition($product->id) !!}</p>
                                        @endisset
                                        @isset($product->brand)<p><b>Manufacturer :</b> {{ $product->brand->name }}</p>@endisset
                                        @isset($product->origin)<p><b>Origin of Medicine :</b> {{ $product->origin }}</p>@endisset
                                    </div>
                                    <div class="mt-3">
                                        <div class="product-quantity d-flex flex-column __gap-15">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-description-label text-dark font-bold mt-0">
                                                    {{translate('quantity')}} :
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10 web-text-primary" type="button"
                                                                data-type="minus" data-field="quantity"
                                                                disabled="disabled">
                                                            -
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                           class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                                           placeholder="{{ translate('1') }}"
                                                           value="{{ $product->minimum_order_qty ?? 1 }}"
                                                           data-producttype="{{ $product->product_type }}"
                                                           min="{{ $product->minimum_order_qty ?? 1 }}"
                                                           max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10 web-text-primary" type="button"
                                                                data-producttype="{{ $product->product_type }}"
                                                                data-type="plus" data-field="quantity">
                                                                +
                                                        </button>
                                                    </span>
                                                </div>
                                                <input type="hidden" class="product-generated-variation-code" name="product_variation_code">
                                                <input type="hidden" value="" class="in_cart_key form-control w-50" name="key">
                                            </div>
                                            <div id="chosen_price_div">
                                                <div
                                                    class="d-none d-sm-flex justify-content-start align-items-center me-2">
                                                    <div
                                                        class="product-description-label text-dark font-bold text-capitalize">
                                                        <strong>{{translate('total_price')}}</strong> :
                                                    </div>
                                                    &nbsp; <strong id="chosen_price" class="text-base"></strong>
                                                    <small
                                                        class="ms-2 font-regular">
                                                        (<small>{{translate('tax')}} : </small>
                                                        <small id="set-tax-amount"></small>)
                                                    </small>
                                                </div>
                                            </div>
                                                @isset($product->contains)<span>{{ $product->contains }}</span>@endisset
                                        </div>
                                    </div>

                                    <div class="__btn-grp mt-2 mb-3 d-none d-sm-flex">
                                        @if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                         ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))))
                                            <button class="btn btn-secondary" type="button" disabled>
                                                {{ translate('buy_now') }}
                                            </button>
                                            <button class="btn btn--primary string-limit" type="button" disabled>
                                                {{ translate('add_to_cart') }}
                                            </button>
                                        @else
                                            <button type="button"
                                                 class="btn btn-secondary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} action-buy-now-this-product">
                                                <span class="string-limit">{{ translate('buy_now') }}</span>
                                            </button>
                                            <button class="btn btn--primary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} action-add-to-cart-form"
                                                type="button" data-update-text="{{ translate('update_cart') }}" data-add-text="{{ translate('add_to_cart') }}">
                                                <span class="string-limit">{{ translate('add_to_cart') }}</span>
                                            </button>
                                        @endif
                                        <button type="button" data-product-id="{{ $product['id'] }}" class="btn __text-18px border d-none d-sm-block product-action-add-wishlist">
                                            <i class="fa {{($wishlistStatus == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}} web-text-primary"
                                               aria-hidden="true"></i>
                                            <span class="fs-14 text-muted align-bottom countWishlist-{{$product['id']}}">{{$countWishlist}}</span>
                                            <div class="wishlist-tooltip" x-placement="top">
                                                <div class="arrow"></div><div class="inner">
                                                    <span class="add">{{translate('added_to_wishlist')}}</span>
                                                    <span class="remove">{{translate('removed_from_wishlist')}}</span>
                                                </div>
                                            </div>
                                        </button>
                                        @if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                         ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))))
                                            <div class="alert alert-danger" role="alert">
                                                {{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row no-gutters d-none flex-start d-flex">
                                        <div class="col-12">
                                            @if(($product['product_type'] == 'physical'))
                                                <h5 class="text-danger out-of-stock-element d--none">{{translate('out_of_stock')}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-4 rtl col-12 text-align-direction">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div
                                            class="px-4 pb-3 mb-3 mr-0 mr-md-2 bg-white __review-overview __rounded-10 pt-3">
                                            <ul class="nav nav-tabs nav--tabs d-flex justify-content-center mt-3"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27 active " href="#overview"
                                                       data-toggle="tab" role="tab">
                                                        {{translate('overview')}}
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27" href="#reviews" data-toggle="tab"
                                                       role="tab">
                                                        {{translate('reviews')}}
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content px-lg-3">
                                                <div class="tab-pane fade show active text-justify" id="overview"
                                                     role="tabpanel">
                                                    <div class="row pt-2 specification">

                                                        @if($product->video_url != null && (str_contains($product->video_url, "youtube.com/embed/")))
                                                            <div class="col-12 mb-4">
                                                                <iframe width="420" height="315"
                                                                        src="{{$product->video_url}}">
                                                                </iframe>
                                                            </div>
                                                        @endif
                                                        @if ($product['details'])
                                                            <div class="text-body col-lg-12 col-md-12 overflow-scroll fs-13 text-justify details-text-justify rich-editor-html-content">
                                                                {!! $product['details'] !!}
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @if (!$product['details'] && ($product->video_url == null || !(str_contains($product->video_url, "youtube.com/embed/"))))
                                                        <div>
                                                            <div class="text-center text-capitalize py-5">
                                                                <img class="mw-90"
                                                                     src="{{theme_asset(path: 'public/assets/front-end/img/icons/nodata.svg')}}"
                                                                     alt="">
                                                                <p class="text-capitalize mt-2">
                                                                    <small>{{translate('product_details_not_found')}}
                                                                        !</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                    @if(count($product->reviews)==0 && $productReviews->total() == 0)
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-100"
                                                                     src="{{theme_asset(path: 'public/assets/front-end/img/icons/empty-review.svg')}}"
                                                                     alt="">
                                                                <p class="text-capitalize">
                                                                    <small>{{translate('No_review_given_yet')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row pt-2 pb-3">
                                                            <div class="col-lg-4 col-md-5 ">
                                                                <div
                                                                    class=" row d-flex justify-content-center align-items-center">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center align-items-center">
                                                                        <h2 class="overall_review mb-2 __inline-28">
                                                                            {{$overallRating[0]}}
                                                                        </h2>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center star-rating ">
                                                                        @for($inc=1;$inc<=5;$inc++)
                                                                            @if ($inc <= (int)$overallRating[0])
                                                                                <i class="tio-star text-warning"></i>
                                                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                                                <i class="tio-star-half text-warning"></i>
                                                                            @else
                                                                                <i class="tio-star-outlined text-warning"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                                        <span class="text-center">
                                                                            {{$productReviews->total()}} {{translate('ratings')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                                                <div
                                                                    class="d-flex align-items-center mb-2 font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle text-body">{{translate('excellent')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress text-body __h-5px">
                                                                            <div class="progress-bar web--bg-primary"
                                                                                 role="progressbar"
                                                                                 style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 text-body">
                                                                        <span
                                                                            class=" {{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}} ">
                                                                            {{$rating[0]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('good')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                                                 aria-valuenow="27" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[1]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                                                 aria-valuenow="17" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[2]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt "><span
                                                                            class="d-inline-block align-middle">{{translate('below_Average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                                                 aria-valuenow="9" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[3]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('poor')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                 aria-valuenow="4" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[4]}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row pb-4 mb-3">
                                                            <div class="__inline-30">
                                                                <span
                                                                    class="text-capitalize">{{ translate('Product_review') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row pb-4">
                                                        <div class="col-12" id="product-review-list">
                                                            @include('web-views.partials._product-reviews')
                                                        </div>

                                                        @if(count($product->reviews) > 2)
                                                            <div class="col-12">
                                                                <div
                                                                    class="card-footer d-flex justify-content-center align-items-center">
                                                                    <button class="btn text-white view_more_button web--bg-primary">
                                                                        {{ translate('view_more') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
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
                <div class="col-lg-3">
                    @php($companyReliability = getWebConfig('company_reliability'))
                    @if($companyReliability != null)
                        <div class="product-details-shipping-details">
                            @foreach ($companyReliability as $key=>$value)
                                @if ($value['status'] == 1 && !empty($value['title']))
                                    <div class="shipping-details-bottom-border">
                                        <div class="px-3 py-3">
                                            <img class="{{Session::get('direction') === "rtl" ? 'float-right ml-2' : 'mr-2'}} __img-20"
                                                 src="{{ getStorageImages(path: imagePathProcessing(imageData: $value['image'],path: 'company-reliability'), type: 'source', source: 'public/assets/front-end/img'.'/'.$value['item'].'.png') }}"
                                                alt="">
                                            <span>{{translate($value['title'])}}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if(getWebConfig(name: 'business_mode')=='multi')
                    <div class="__inline-31">

                        @if($product->added_by=='seller')
                            @if(isset($product->seller->shop))
                                <div class="row position-relative">
                                    <div class="col-12 position-relative">
                                        <a href="{{route('shopView',['id'=>$product->seller->id])}}" class="d-block">
                                            <div class="d-flex __seller-author align-items-center">
                                                <div>
                                                    <img class="__img-60 img-circle" alt=""
                                                         src="{{ getStorageImages(path: $product?->seller?->shop->image_full_url, type: 'shop') }}">
                                                </div>
                                                <div
                                                    class="ms-2 w-0 flex-grow">
                                                    <h6>
                                                        {{$product->seller->shop->name}}
                                                    </h6>
                                                    <span class="text-capitalize">{{translate('vendor_info')}}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">

                                                @if($sellerTemporaryClose || ($product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))
                                                    <span class="chat-seller-info product-details-seller-info"
                                                          data-toggle="tooltip"
                                                          title="{{ translate('this_shop_is_temporary_closed_or_on_vacation').' '.translate('You_cannot_add_product_to_cart_from_this_shop_for_now') }}">
                                                        <img src="{{theme_asset(path: 'public/assets/front-end/img/info.png')}}" alt="i">
                                                    </span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-6 ">
                                                <div
                                                    class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                    <div class="text-center">
                                                        <img src="{{theme_asset(path: 'public/assets/front-end/img/rating.svg')}}"
                                                             class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$totalReviews}}</strong> {{translate('reviews')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div
                                                    class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                    <div class="text-center">
                                                        <img
                                                            src="{{theme_asset(path: 'public/assets/front-end/img/products.svg')}}"
                                                            class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$productsForReview->count()}}</strong> {{translate('products')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 position-static mt-3">
                                        <div class="chat_with_seller-buttons">
                                            @if (auth('customer')->id())
                                                <button class="btn w-100 d-block text-center web--bg-primary text-white"
                                                        data-toggle="modal"
                                                        data-target="#chatting_modal" {{ ($product->seller->shop->temporary_close || ($product->seller->shop->vacation_status && date('Y-m-d') >= date('Y-m-d', strtotime($product->seller->shop->vacation_start_date)) && date('Y-m-d') <= date('Y-m-d', strtotime($product->seller->shop->vacation_end_date)))) ? 'disabled' : '' }}>
                                                    <img class="mb-1" alt=""
                                                        src="{{theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')}}">
                                                    <span class="d-none d-sm-inline-block text-capitalize">
                                                        {{translate('chat_with_vendor')}}
                                                    </span>
                                                </button>
                                            @else
                                                <a href="{{route('customer.auth.login')}}"
                                                   class="btn w-100 d-block text-center web--bg-primary text-white">
                                                    <img src="{{theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')}}"
                                                        class="mb-1" alt="">
                                                    <span class="d-none d-sm-inline-block text-capitalize">{{translate('chat_with_vendor')}}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row d-flex justify-content-between">
                                <div class="col-9 ">
                                    <a href="{{route('shopView',[0])}}" class="row d-flex ">
                                        <div>
                                            <img class="__inline-32" alt=""
                                                 src="{{ getStorageImages(path:$web_config['fav_icon'], type: 'logo') }}">
                                        </div>
                                        <div class="{{Session::get('direction') === "rtl" ? 'right' : 'mt-3 ml-2'}} get-view-by-onclick"
                                             data-link="{{ route('shopView',[0]) }}">
                                            <span class="font-bold __text-16px">
                                                {{$web_config['name']->value}}
                                            </span><br>
                                        </div>

                                        @if($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))
                                            <div class="{{Session::get('direction') === "rtl" ? 'right' : 'ml-3'}}">
                                                <span class="chat-seller-info" data-toggle="tooltip"
                                                      title="{{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}">
                                                    <img src="{{theme_asset(path: 'public/assets/front-end/img/info.png')}}"
                                                         alt="i">
                                                </span>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6 ">
                                            <div
                                                class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                <div class="text-center">
                                                    <img src="{{theme_asset(path: 'public/assets/front-end/img/rating.svg')}}"
                                                         class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$totalReviews}}</strong> {{translate('reviews')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div
                                                class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                <div class="text-center">
                                                    <img src="{{theme_asset(path: 'public/assets/front-end/img/products.svg')}}"
                                                         class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$productsForReview->count()}}</strong> {{translate('products')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 position-static mt-3">
                                    <div class="chat_with_seller-buttons">
                                        @if (auth('customer')->id())
                                            <button class="btn w-100 d-block text-center web--bg-primary text-white"
                                                    data-toggle="modal"
                                                    data-target="#chatting_modal" {{ ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)) ? 'disabled' : '' }}>
                                                <img class="mb-1" alt=""
                                                     src="{{ theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')}}">
                                                <span class="d-none d-sm-inline-block text-capitalize">
                                                        {{translate('chat_with_vendor')}}
                                                    </span>
                                            </button>
                                        @else
                                            <a href="{{ route('shopView',[0]) }}" class="text-center d-block w-100">
                                                <button class="btn text-center d-block w-100 text-white web--bg-primary">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                    {{translate('visit_Store')}}
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif

                    <div class="pt-4 pb-3">
                        <span class=" __text-16px font-bold text-capitalize">
                            {{ translate('author_Details')}}
                        </span>
                    </div>
                    <div>
                        @foreach($authorDetails as $item)
                            @include('web-views.partials._product-author-details',['product'=>$item,'decimal_point_settings'=>$decimalPointSettings])
                        @endforeach
                    </div>

                    <div class="pt-4 pb-3">
                        <span class=" __text-16px font-bold text-capitalize">
                            @if(getWebConfig(name: 'business_mode')=='multi')
                                {{ translate('more_from_the_store')}}
                            @else
                                {{ translate('you_may_also_like')}}
                            @endif
                        </span>
                    </div>
                    <div>
                        @foreach($moreProductFromSeller as $item)
                            @include('web-views.partials._seller-products-product-details',['product'=>$item,'decimal_point_settings'=>$decimalPointSettings])
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card col-lg-9 col-12 p-3">
                    <h5>Fact Box of {{ $product->name }}</h5>
                    <figure class="table table-responsive">
                        <table class="table table-responsive">
                            <tbody>
                                <tr><td><p style="text-align: justify;">Molecule name:&nbsp;<strong> &nbsp;{!! salt_composition($product->id) !!}&nbsp;</strong></p></td><td><p style="text-align: justify;">Therapeutic class: <strong>{{ isset($product->department) ? $product->department->name : 'N/A' }}</strong></p></td>
                                </tr>

                                <tr>
                                    <td><p style="text-align: justify;">Pharmacological class:<strong> N/A</strong></p></td>
                                    <td>
                                        {!! product_indication($product->id) !!}
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                    </figure>
                </div>
            </div>

            @isset($product->reference)
            <div class="row">
                <div class="card col-lg-9 col-12 p-3">
                    <h5>References</h5>
                    <p>{{ $product->reference }}</p>
                </div>
            </div>
            @endif

            @isset($product->disclaimer)
            <div class="row">
                <div class="card col-lg-9 col-12 p-3">
                    <h5>Disclaimer</h5>
                    <p>{{ $product->disclaimer }}</p>
                </div>
            </div>
            @endisset

        </div>

        <div class="bottom-sticky bg-white d-sm-none">
            <div class="d-flex flex-column gap-1 py-2">
                <div class="d-flex justify-content-center align-items-center fs-13">
                    <div class="product-description-label text-dark font-bold"><strong
                            class="text-capitalize">{{translate('total_price')}}</strong> :
                    </div>
                    &nbsp; <strong id="chosen_price_mobile" class="text-base"></strong>
                    <small class="ml-2  font-regular">
                        (<small>{{translate('tax')}} : </small>
                        <small id="set-tax-amount-mobile"></small>)
                    </small>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    @if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                        ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))))
                        <button
                            class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                            type="button" disabled>
                            {{translate('buy_now')}}
                        </button>
                        <button
                            class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                            type="button" disabled>
                            {{translate('add_to_cart')}}
                        </button>
                    @else
                        <button
                            class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} action-buy-now-this-product" type="button">
                            <span class="string-limit">{{translate('buy_now')}}</span>
                        </button>
                        <button
                            class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} action-add-to-cart-form"
                            type="button">
                            <span class="string-limit">{{translate('add_to_cart')}}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        @if (count($relatedProducts)>0)
            <div class="container rtl text-align-direction">
                <div class="card __card border-0">
                    <div class="card-body">
                        <div class="row flex-between">
                            <div class="ms-1">
                                <h4 class="text-capitalize font-bold fs-16">{{ translate('similar_products')}}</h4>
                            </div>
                            <div class="view_all d-flex justify-content-center align-items-center">
                                <div>
                                    @php($category=json_decode($product['category_ids']))
                                    @if($category)
                                        <a class="text-capitalize view-all-text web-text-primary me-1"
                                           href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ translate('view_all')}}
                                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1'}}"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            @foreach($relatedProducts as $key => $relatedProduct)
                                <div class="col-xl-2 col-sm-3 col-6">
                                    @include('web-views.partials._inline-single-product-without-eye',['product'=>$relatedProduct,'decimal_point_settings'=>$decimalPointSettings])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade rtl text-align-direction" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body flex justify-content-center">
                        <button class="btn btn-default __inline-33 dir-end-minus-7px"
                                data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                        <img class="element-center" id="attachment-view" src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.front-end.partials.modal._chatting',['seller'=>$product->seller, 'user_type'=>$product->added_by])


    <span id="route-review-list-product" data-url="{{ route('review-list-product') }}"></span>
    <span id="products-details-page-data" data-id="{{ $product['id'] }}"></span>
@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/product-details.js') }}"></script>
    <script type="text/javascript" async="async"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"></script>
@endpush
