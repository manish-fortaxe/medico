@php
    $overallRating = getOverallRating($product->reviews);
    $rating = getRating($product->reviews);
    $productReviews = \App\Utils\ProductManager::get_product_review($product->id);
@endphp

<div class="modal-header rtl">
    <div>
        <h4 class="modal-title product-title">
            <a class="product-title2" href="{{route('product',$product->slug)}}" data-toggle="tooltip"
               data-placement="right"
               title="Go to product page">{{$product['name']}}
                <i class="czi-arrow-{{ Session::get('direction') === "rtl" ? 'left' : 'right' }} ms-2 font-size-lg mr-0"></i>
            </a>
        </h4>
    </div>
    <div>
        <button class="close call-when-done" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<div class="modal-body rtl">
    <div class="row ">
        <div class="col-lg-5 col-md-4 col-12">
            <div class="cz-product-gallery position-relative">
                <div class="cz-preview">
                    <div id="sync1" class="owl-carousel owl-theme product-thumbnail-slider">
                        @if($product->images!=null && json_decode($product->images)>0)
                            @if(json_decode($product->colors) && count($product->color_images_full_url)>0)
                                @foreach ($product->color_images_full_url as $key => $photo)
                                    @if($photo['color'] != null)
                                        <div class="product-preview-item d-flex align-items-center justify-content-center">
                                            <img class="show-imag img-responsive max-height-500px"
                                                 src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                                 alt="{{ translate('product') }}" width="">
                                        </div>
                                    @else
                                        <div class="product-preview-item d-flex align-items-center justify-content-center">
                                            <img class="show-imag img-responsive max-height-500px"
                                                 src="{{ getStorageImages(path:$photo['image_name'], type: 'product') }}"
                                                 alt="{{ translate('product') }}" width="">
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($product->images_full_url as $key => $photo)
                                    <div class="product-preview-item d-flex align-items-center justify-content-center">
                                        <img class="show-imag img-responsive max-height-500px"
                                             src="{{ getStorageImages(path: $photo, type: 'product') }}"
                                             alt="{{ translate('product') }}">
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

                <div class="cz-product-gallery-icons">
                    <div class="d-flex flex-column">
                        <button type="button" data-product-id="{{ $product['id'] }}"
                                class="btn __text-18px border wishList-pos-btn d-sm-none product-action-add-wishlist">
                            <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}} web-text-primary"
                               id="wishlist_icon_{{$product['id']}}" aria-hidden="true"></i>
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
                </div>

                <div class="table-responsive">
                    <div class="d-flex">
                        <div id="sync2" class="owl-carousel owl-theme product-thumb-slider max-height-100px d--none">
                            @if($product->images!=null && json_decode($product->images)>0)
                                @if(json_decode($product->colors) && count($product->color_images_full_url)>0)
                                    @foreach ($product->color_images_full_url as $key => $photo)
                                        @if($photo['color'] != null)
                                            <div class="">
                                                <a href="javascript:"
                                                   class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                    <img class="click-img" id="preview-img{{$photo['color']}}"
                                                         src="{{ getStorageImages(path:$photo['image_name'], type: 'product') }}"
                                                         alt="{{ translate('product') }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="">
                                                <a href="javascript:"
                                                   class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                    <img class="click-img" id="preview-img{{$key}}"
                                                         src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                                         alt="{{ translate('product') }}">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($product->images_full_url as $key => $photo)
                                        <div class="">
                                            <a href="javascript:"
                                               class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                <img class="click-img" id="preview-img{{$key}}"
                                                     src="{{ getStorageImages(path: $photo, type: 'product') }}"
                                                     alt="{{ translate('product') }}">
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

        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3 web-direction">
            <div class="details __h-100">
                <a href="{{route('product',$product->slug)}}" class="h3 mb-2 product-title">{{$product->name}}</a>

                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                    <div class="star-rating me-2">
                        @for($inc=0;$inc<5;$inc++)
                            @if($inc<$overallRating[0])
                                <i class="sr-star czi-star-filled active"></i>
                            @else
                                <i class="sr-star czi-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span
                            class="d-inline-block  align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'}} fs-14 text-muted">({{$overallRating[0]}})</span>
                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span class="web-text-primary">{{$overallRating[1]}}</span> {{translate('reviews')}}</span>
                    <span class="__inline-25"></span>
                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">
                        <span class="web-text-primary">
                            {{$countOrder}}
                        </span> {{translate('orders')}}   </span>
                    <span class="__inline-25">    </span>
                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}} text-capitalize">
                        <span class="web-text-primary countWishlist-{{ $product->id }}"> {{$countWishlist}}</span> {{translate('wish_listed')}}
                    </span>

                </div>

                <div class="mb-3">
                    <span class="font-weight-normal text-accent d-flex align-items-end gap-2">
                        {!! getPriceRangeWithDiscount(product: $product) !!}
                    </span>
                </div>
                <div class="mb-2">
                    @if($product?->is_prescription == 1)
                    <span class="badge badge-pill badge-info" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path fill="#69b3fe" d="M301.3 352l78.1-78.1c6.3-6.3 6.3-16.4 0-22.6l-22.6-22.6c-6.3-6.3-16.4-6.3-22.6 0L256 306.7l-84-84C219.3 216.8 256 176.9 256 128c0-53-43-96-96-96H16C7.2 32 0 39.2 0 48v256c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-80h18.8l128 128-78.1 78.1c-6.3 6.3-6.3 16.4 0 22.6l22.6 22.6c6.3 6.3 16.4 6.3 22.6 0L256 397.3l78.1 78.1c6.3 6.3 16.4 6.3 22.6 0l22.6-22.6c6.3-6.3 6.3-16.4 0-22.6L301.3 352zM64 96h96c17.6 0 32 14.4 32 32s-14.4 32-32 32H64V96z"/></svg> Prescription</span>

                    @endisset

                    @if($product?->cold_chain)
                    <span class="badge badge-pill badge-primary" data-toggle="tooltip" data-placement="top" title="Medicines Packed And Stored At The Optimum Temperature"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path fill="#fe696a" d="M440.3 345.2l-33.8-19.5 26-7c8.2-2.2 13.1-10.7 10.9-18.9l-4-14.9c-2.2-8.2-10.7-13.1-18.9-10.9l-70.8 19-63.9-37 63.8-36.9 70.8 19c8.2 2.2 16.7-2.7 18.9-10.9l4-14.9c2.2-8.2-2.7-16.7-10.9-18.9l-26-7 33.8-19.5c7.4-4.3 9.9-13.7 5.7-21.1L430.4 119c-4.3-7.4-13.7-9.9-21.1-5.7l-33.8 19.5 7-26c2.2-8.2-2.7-16.7-10.9-18.9l-14.9-4c-8.2-2.2-16.7 2.7-18.9 10.9l-19 70.8-62.8 36.2v-77.5l53.7-53.7c6.2-6.2 6.2-16.4 0-22.6l-11.3-11.3c-6.2-6.2-16.4-6.2-22.6 0L256 56.4V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v40.4l-19.7-19.7c-6.2-6.2-16.4-6.2-22.6 0L138.3 48c-6.3 6.2-6.3 16.4 0 22.6l53.7 53.7v77.5l-62.8-36.2-19-70.8c-2.2-8.2-10.7-13.1-18.9-10.9l-14.9 4c-8.2 2.2-13.1 10.7-10.9 18.9l7 26-33.8-19.5c-7.4-4.3-16.8-1.7-21.1 5.7L2.1 145.7c-4.3 7.4-1.7 16.8 5.7 21.1l33.8 19.5-26 7c-8.3 2.2-13.2 10.7-11 19l4 14.9c2.2 8.2 10.7 13.1 18.9 10.9l70.8-19 63.8 36.9-63.8 36.9-70.8-19c-8.2-2.2-16.7 2.7-18.9 10.9l-4 14.9c-2.2 8.2 2.7 16.7 10.9 18.9l26 7-33.8 19.6c-7.4 4.3-9.9 13.7-5.7 21.1l15.5 26.8c4.3 7.4 13.7 9.9 21.1 5.7l33.8-19.5-7 26c-2.2 8.2 2.7 16.7 10.9 18.9l14.9 4c8.2 2.2 16.7-2.7 18.9-10.9l19-70.8 62.8-36.2v77.5l-53.7 53.7c-6.3 6.2-6.3 16.4 0 22.6l11.3 11.3c6.2 6.2 16.4 6.2 22.6 0l19.7-19.7V496c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-40.4l19.7 19.7c6.2 6.2 16.4 6.2 22.6 0l11.3-11.3c6.2-6.2 6.2-16.4 0-22.6L256 387.7v-77.5l62.8 36.2 19 70.8c2.2 8.2 10.7 13.1 18.9 10.9l14.9-4c8.2-2.2 13.1-10.7 10.9-18.9l-7-26 33.8 19.5c7.4 4.3 16.8 1.7 21.1-5.7l15.5-26.8c4.3-7.3 1.8-16.8-5.6-21z"/></svg> Cold Chain</span>

                    @endisset

                    @if($product?->pap_description)
                    <span class="badge badge-pill badge-success"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px;"><path fill="#42d697" d="M277.4 12C261.1 4.5 243.1 0 224 0c-53.7 0-99.5 33.1-118.5 80h81.2l90.7-68zM342.5 80c-7.9-19.5-20.7-36.2-36.5-49.5L240 80h102.5zM224 256c70.7 0 128-57.3 128-128 0-5.5-1-10.7-1.6-16H97.6c-.7 5.3-1.6 10.5-1.6 16 0 70.7 57.3 128 128 128zM80 299.7V512h128.3l-98.5-221.5A132.8 132.8 0 0 0 80 299.7zM0 464c0 26.5 21.5 48 48 48V320.2C18.9 344.9 0 381.3 0 422.4V464zm256-48h-55.4l42.7 96H256c26.5 0 48-21.5 48-48s-21.5-48-48-48zm57.6-128h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.7-5.8-72.9-16h-7.4l42.7 96H256c44.1 0 80 35.9 80 80 0 18.1-6.3 34.6-16.4 48H400c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg> PAP Scheme</span>
                    @endisset

                </div>
                <div class="mb-3">
                    @isset($product->tags)
                    <p><b>Salt Composition :</b> {!! salt_composition($product->id) !!}</p>
                    @endisset
                    @isset($product->brand)<p><b>Manufacturer :</b> {{ $product->brand->name }}</p>@endisset
                    @isset($product->origin)<p><b>Origin of Medicine :</b> {{ $product->origin }}</p>@endisset
                </div>
                <form id="add-to-cart-form" class="mb-2">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-3">
                        @if (count(json_decode($product->colors)) > 0)
                            <div class="flex-start">
                                <div class="product-description-label text-dark font-bold">
                                    {{translate('color')}}:
                                </div>
                                <div class="__pl-15 mt-1">
                                    <ul class="flex-start checkbox-color mb-0 p-0 list-inline">
                                        @foreach (json_decode($product->colors) as $key => $color)
                                            <li>
                                                <input type="radio"
                                                       id="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                       name="color" value="{{ $color }}"
                                                       @if($key == 0) checked @endif>
                                                <label style="background: {{ $color }};"
                                                    class="quick-view-preview-image-by-color shadow-border"
                                                    for="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                    data-toggle="tooltip"
                                                    data-key="{{ str_replace('#','',$color) }}" data-title="{{ \App\Utils\get_color_name($color) }}">
                                                    <span class="outline"></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @php
                            $qty = 0;
                            foreach (json_decode($product->variation) as $key => $variation) {
                                $qty += $variation->qty;
                            }
                        @endphp

                    </div>

                    @foreach (json_decode($product->choice_options) as $key => $choice)
                        <div class="flex-start">
                            <div class="product-description-label text-dark font-bold mt-1 text-capitalize">
                                {{ $choice->title }}:
                            </div>
                            <div>
                                <ul class="checkbox-alphanumeric checkbox-alphanumeric--style-1 mt-1">
                                    @foreach ($choice->options as $index => $option)
                                        <span>
                                            <input type="radio" id="{{ $choice->name }}-{{ $option }}" name="{{ $choice->name }}"
                                                   value="{{ $option }}" @if($index==0) checked @endif>
                                            <label class="user-select-none" for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                        </span>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach

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

                    <div class="mb-3">
                        <div class="product-quantity d-flex flex-column __gap-15">
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-description-label text-dark font-bold mt-0">{{translate('quantity')}}
                                    :
                                </div>
                                <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">
                                <span class="input-group-btn">
                                    <button class="btn btn-number __p-10 web-text-primary" type="button" data-type="minus"
                                            data-field="quantity"
                                            disabled="disabled">
                                        -
                                    </button>
                                </span>
                                    <input type="text" name="quantity"
                                           class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                           placeholder="{{ translate('1') }}" value="{{ $product->minimum_order_qty ?? 1 }}"
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
                                        class="d-flex justify-content-start align-items-center me-2">
                                    <div class="product-description-label text-dark font-bold text-capitalize">
                                        <strong>{{translate('total_price')}}</strong> :
                                    </div>
                                    &nbsp; <strong id="chosen_price" class="text-base"></strong>
                                    <small class="ms-2 font-regular">
                                        (<small>{{translate('tax')}} : </small>
                                        <small id="set-tax-amount"></small>)
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="__btn-grp align-items-center mb-2">
                        @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) &&
                        $product->seller->shop->vacation_status && $currentDate >= $seller_vacation_start_date && $currentDate
                        <= $seller_vacation_end_date))) || ($product->added_by == 'admin' && ($inhouse_temporary_close ||
                            ($inHouseVacationStatus && $currentDate >= $inhouse_vacation_start_date && $currentDate <=
                                $inhouse_vacation_end_date))))

                            <button class="btn btn-secondary" type="button" disabled>
                                {{translate('buy_now')}}
                            </button>

                            <button class="btn btn--primary string-limit" type="button" disabled>
                                {{translate('add_to_cart')}}
                            </button>
                        @else
                            <button class="btn btn-secondary action-buy-now-this-product"
                            type="button">
                                {{translate('buy_now')}}
                            </button>
                            <button class="btn btn--primary string-limit action-add-to-cart-form" type="button" data-update-text="{{ translate('update_cart') }}" data-add-text="{{ translate('add_to_cart') }}">
                                {{translate('add_to_cart')}}
                            </button>
                        @endif

                        <button type="button" data-product-id="{{$product['id']}}" class="btn __text-18px border product-action-add-wishlist">
                            <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}} web-text-primary"
                            id="wishlist_icon_{{$product['id']}}" aria-hidden="true"></i>
                            <span class="fs-14 text-muted align-bottom countWishlist-{{$product['id']}}">
                                {{$countWishlist}}
                            </span>
                            <div class="wishlist-tooltip" x-placement="top">
                                <div class="arrow"></div><div class="inner">
                                    <span class="add">{{translate('added_to_wishlist')}}</span>
                                    <span class="remove">{{translate('removed_from_wishlist')}}</span>
                                </div>
                            </div>
                        </button>

                        @if(($product->added_by == 'seller' && ($seller_temporary_close ||
                        (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >=
                        $seller_vacation_start_date && $currentDate <= $seller_vacation_end_date))) || ($product->
                            added_by == 'admin' && ($inhouse_temporary_close || ($inHouseVacationStatus &&
                            $currentDate >= $inhouse_vacation_start_date && $currentDate <= $inhouse_vacation_end_date))))
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
</div>

<script type="text/javascript">
    "use strict";
    productQuickViewFunctionalityInitialize();
</script>

<script type="text/javascript" async="async"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"></script>

