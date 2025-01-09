@if(isset($product))
<div class="flash_deal_product rtl cursor-pointer mb-2 get-view-by-onclick">

    <div class="d-flex align-items-center p-3 gap-3">
        <!-- Product Image -->
        <div class="flash-deals-background-image image-default-bg-color">
            <img class="__img-125px" alt="" src="{{ getStorageImages(path: $product->image_full_url, type: 'product') }}">
        </div>

        <!-- Product Details -->
        <div class="flash_deal_product_details d-flex flex-column justify-content-center">
            <!-- Product Title -->
            <div>
                <span class="flash-product-title">
                    {{$product['name']}}
                </span>
            </div>
            <!-- Product Degree -->
            <div>
                <span class="flash-product-price fw-semibold text-dark">
                    {{$product['degree']}}
                </span>
            </div>
        </div>
    </div>

</div>
@endif
