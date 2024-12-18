@if(isset($product))
<div class="flash_deal_product rtl cursor-pointer mb-2 get-view-by-onclick">

    <div class="d-flex">
        <div class="d-flex align-items-center justify-content-center p-3">
            <div class="flash-deals-background-image image-default-bg-color">
                <img class="__img-125px" alt="" src="{{ getStorageImages(path: $product->image_full_url, type: 'product') }}">
            </div>
        </div>
        <div class=" flash_deal_product_details pl-3 pr-3 pr-1 d-flex align-items-center">
            <div>
                <div>
                    <span class="flash-product-title">
                        {{$product['name']}}
                    </span>
                </div>
                <div class="d-flex flex-wrap gap-8 align-items-center row-gap-0">
                    <span class="flash-product-price fw-semibold text-dark">
                        {{$product['degree']}}
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
@endif
