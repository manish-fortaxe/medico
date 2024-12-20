@php($overallRating = getOverallRating($product->reviews))
<div class="product-single-hover style--category shadow-none">
    <div class="overflow-hidden position-relative">
        <div class=" inline_product clickable d-flex justify-content-center">
            @if($product->discount > 0)
                <div class="d-flex">
                    <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                        <span class="direction-ltr d-block">
                            @if ($product->discount_type == 'percent')
                                -{{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                            @elseif($product->discount_type =='flat')
                                -{{ webCurrencyConverter(amount: $product->discount) }}
                            @endif
                        </span>
                    </span>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <span class="for-discount-value-null"></span>
                </div>
            @endif
            <div class="d-block pb-0">
                <a href="{{route('product',$product->slug)}}" class="d-block">
                    <img alt=""
                         src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}">
                </a>
            </div>

            <div class="quick-view">
                <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="{{ $product->id }}">
                    <i class="czi-eye align-middle"></i>
                </a>
            </div>
            @if($product->product_type == 'physical' && $product->current_stock <= 0)
                <span class="out_fo_stock">{{translate('out_of_stock')}}</span>
            @endif
        </div>
        <div class="single-product-details">
            @if($overallRating[0] != 0 )
                <div class="rating-show justify-content-between">
                <span class="d-inline-block font-size-sm text-body">
                    @for($inc=1;$inc<=5;$inc++)
                        @if ($inc <= (int)$overallRating[0])
                            <i class="tio-star text-warning"></i>
                        @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                            <i class="tio-star-half text-warning"></i>
                        @else
                            <i class="tio-star-outlined text-warning"></i>
                        @endif
                    @endfor
                    <label class="badge-style">( {{ count($product->reviews) }} )</label>
                </span>
                </div>
            @endif
            <div class="">
                <a href="{{route('product',$product->slug)}}" class="text-capitalize fw-semibold">
                    {{ Str::limit($product['name'], 18) }}
                </a>
            </div>
            <div class="">
                @if($product?->is_prescription == 1)
                <span class="badge badge-pill badge-info" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path fill="#69b3fe" d="M301.3 352l78.1-78.1c6.3-6.3 6.3-16.4 0-22.6l-22.6-22.6c-6.3-6.3-16.4-6.3-22.6 0L256 306.7l-84-84C219.3 216.8 256 176.9 256 128c0-53-43-96-96-96H16C7.2 32 0 39.2 0 48v256c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-80h18.8l128 128-78.1 78.1c-6.3 6.3-6.3 16.4 0 22.6l22.6 22.6c6.3 6.3 16.4 6.3 22.6 0L256 397.3l78.1 78.1c6.3 6.3 16.4 6.3 22.6 0l22.6-22.6c6.3-6.3 6.3-16.4 0-22.6L301.3 352zM64 96h96c17.6 0 32 14.4 32 32s-14.4 32-32 32H64V96z"/></svg> </span>

                @endisset

                @if($product?->cold_chain)
                <span class="badge badge-pill badge-primary" data-toggle="tooltip" data-placement="top" title="Medicines Packed And Stored At The Optimum Temperature"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 20px;"><path fill="#fe696a" d="M440.3 345.2l-33.8-19.5 26-7c8.2-2.2 13.1-10.7 10.9-18.9l-4-14.9c-2.2-8.2-10.7-13.1-18.9-10.9l-70.8 19-63.9-37 63.8-36.9 70.8 19c8.2 2.2 16.7-2.7 18.9-10.9l4-14.9c2.2-8.2-2.7-16.7-10.9-18.9l-26-7 33.8-19.5c7.4-4.3 9.9-13.7 5.7-21.1L430.4 119c-4.3-7.4-13.7-9.9-21.1-5.7l-33.8 19.5 7-26c2.2-8.2-2.7-16.7-10.9-18.9l-14.9-4c-8.2-2.2-16.7 2.7-18.9 10.9l-19 70.8-62.8 36.2v-77.5l53.7-53.7c6.2-6.2 6.2-16.4 0-22.6l-11.3-11.3c-6.2-6.2-16.4-6.2-22.6 0L256 56.4V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v40.4l-19.7-19.7c-6.2-6.2-16.4-6.2-22.6 0L138.3 48c-6.3 6.2-6.3 16.4 0 22.6l53.7 53.7v77.5l-62.8-36.2-19-70.8c-2.2-8.2-10.7-13.1-18.9-10.9l-14.9 4c-8.2 2.2-13.1 10.7-10.9 18.9l7 26-33.8-19.5c-7.4-4.3-16.8-1.7-21.1 5.7L2.1 145.7c-4.3 7.4-1.7 16.8 5.7 21.1l33.8 19.5-26 7c-8.3 2.2-13.2 10.7-11 19l4 14.9c2.2 8.2 10.7 13.1 18.9 10.9l70.8-19 63.8 36.9-63.8 36.9-70.8-19c-8.2-2.2-16.7 2.7-18.9 10.9l-4 14.9c-2.2 8.2 2.7 16.7 10.9 18.9l26 7-33.8 19.6c-7.4 4.3-9.9 13.7-5.7 21.1l15.5 26.8c4.3 7.4 13.7 9.9 21.1 5.7l33.8-19.5-7 26c-2.2 8.2 2.7 16.7 10.9 18.9l14.9 4c8.2 2.2 16.7-2.7 18.9-10.9l19-70.8 62.8-36.2v77.5l-53.7 53.7c-6.3 6.2-6.3 16.4 0 22.6l11.3 11.3c6.2 6.2 16.4 6.2 22.6 0l19.7-19.7V496c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-40.4l19.7 19.7c6.2 6.2 16.4 6.2 22.6 0l11.3-11.3c6.2-6.2 6.2-16.4 0-22.6L256 387.7v-77.5l62.8 36.2 19 70.8c2.2 8.2 10.7 13.1 18.9 10.9l14.9-4c8.2-2.2 13.1-10.7 10.9-18.9l-7-26 33.8 19.5c7.4 4.3 16.8 1.7 21.1-5.7l15.5-26.8c4.3-7.3 1.8-16.8-5.6-21z"/></svg> </span>

                @endisset

                @if($product?->pap_description)
                <span class="badge badge-pill badge-success"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px;"><path fill="#42d697" d="M277.4 12C261.1 4.5 243.1 0 224 0c-53.7 0-99.5 33.1-118.5 80h81.2l90.7-68zM342.5 80c-7.9-19.5-20.7-36.2-36.5-49.5L240 80h102.5zM224 256c70.7 0 128-57.3 128-128 0-5.5-1-10.7-1.6-16H97.6c-.7 5.3-1.6 10.5-1.6 16 0 70.7 57.3 128 128 128zM80 299.7V512h128.3l-98.5-221.5A132.8 132.8 0 0 0 80 299.7zM0 464c0 26.5 21.5 48 48 48V320.2C18.9 344.9 0 381.3 0 422.4V464zm256-48h-55.4l42.7 96H256c26.5 0 48-21.5 48-48s-21.5-48-48-48zm57.6-128h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.7-5.8-72.9-16h-7.4l42.7 96H256c44.1 0 80 35.9 80 80 0 18.1-6.3 34.6-16.4 48H400c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg></span>
                @endisset
            </div>
            <div class="justify-content-between ">
                <div class="product-price d-flex flex-wrap gap-8 align-items-center row-gap-0">
                    @if($product->discount > 0)
                        <del class="category-single-product-price">
                            {{ webCurrencyConverter(amount: $product->unit_price) }}
                        </del>
                    @endif
                    <span class="text-accent text-dark">
                        {{ webCurrencyConverter(amount:
                            $product->unit_price-(getProductDiscount(product: $product, price: $product->unit_price))
                        ) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


