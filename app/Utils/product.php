<?php

use App\Models\Molecule;
use App\Models\Product;
use App\Models\ProductMolecule;
use App\Models\ProductTag;
use App\Models\Review;
use App\Models\Tag;

if (!function_exists('getOverallRating')) {
    function getOverallRating(object|array $reviews): array
    {
        $totalRating = count($reviews);
        $rating = 0;
        foreach ($reviews as $key => $review) {
            $rating += $review->rating;
        }
        if ($totalRating == 0) {
            $overallRating = 0;
        } else {
            $overallRating = number_format($rating / $totalRating, 2);
        }

        return [$overallRating, $totalRating];
    }
}

if (!function_exists('getRating')) {
    function getRating(object|array $reviews): array
    {
        $rating5 = 0;
        $rating4 = 0;
        $rating3 = 0;
        $rating2 = 0;
        $rating1 = 0;
        foreach ($reviews as $key => $review) {
            if ($review->rating == 5) {
                $rating5 += 1;
            }
            if ($review->rating == 4) {
                $rating4 += 1;
            }
            if ($review->rating == 3) {
                $rating3 += 1;
            }
            if ($review->rating == 2) {
                $rating2 += 1;
            }
            if ($review->rating == 1) {
                $rating1 += 1;
            }
        }
        return [$rating5, $rating4, $rating3, $rating2, $rating1];
    }
}

if (!function_exists('getProductDiscount')) {
    /**
     * @param object|array $product
     * @param string|float|int $price
     * @return float
     */
    function getProductDiscount(object|array $product, string|float|int $price): float
    {
        $discount = 0;
        if ($product['discount_type'] == 'percent') {
            $discount = ($price * $product['discount']) / 100;
        } elseif ($product['discount_type'] == 'flat') {
            $discount = $product['discount'];
        }

        return floatval($discount);
    }
}

if (!function_exists('getPriceRangeWithDiscount')) {
    function getPriceRangeWithDiscount(array|object $product): float|string
    {
        $productUnitPrice = $product->unit_price;
        foreach (json_decode($product->variation) as $key => $variation) {
            if ($key == 0) {
                $productUnitPrice = $variation->price;
            }
        }

        if ($product->digitalVariation && count($product->digitalVariation) > 0) {
            $digitalVariations = $product->digitalVariation->toArray();
            $productUnitPrice = $digitalVariations[0]['price'];
        }

        if ($product->discount > 0) {
            $productDiscountedPrice = webCurrencyConverter(amount: $productUnitPrice - getProductDiscount(product: $product, price: $productUnitPrice));
            return '<span class="discounted_unit_price fs-24 font-bold">' . $productDiscountedPrice . '</span>' . '<del class="total_unit_price align-middle text-muted fs-18 font-semibold">' . webCurrencyConverter(amount: $productUnitPrice) . '</del>';
        } else {
            return '<span class="discounted_unit_price fs-24 font-bold">' . webCurrencyConverter(amount: $productUnitPrice) . '</span>';
        }
    }
}

if (!function_exists('getRatingCount')) {
    function getRatingCount($product_id, $rating)
    {
        return Review::where(['product_id' => $product_id, 'rating' => $rating])->whereNull('delivery_man_id')->count();
    }
}

if (!function_exists('units')) {
    function units(): array
    {
        return ['kg', 'pc', 'gms', 'ltrs','pair','oz','lb'];
    }
}
if (!function_exists('getVendorProductsCount')) {
    function getVendorProductsCount(string $type):int
    {
        $products = \Illuminate\Support\Facades\DB::table('products')->where(['added_by'=>'seller'])->get();
        return match ($type) {
            'new-product' => $products->where('request_status', 0)->count(),
            'product-updated-request' => $products->whereNotNull('is_shipping_cost_updated')->where('is_shipping_cost_updated', 0)->count(),
            'approved' => $products->where('request_status', 1)->count(),
            'denied' => $products->where('request_status', 2)->where('status' , 0)->count(),
        };
    }
}
if (!function_exists('getAdminProductsCount')) {
    function getAdminProductsCount(string $type):int
    {
        $products = \Illuminate\Support\Facades\DB::table('products')->where(['added_by'=>'admin'])->get();
        return match ($type) {
            'all' => $products->count(),
            'new-product' => $products->where('request_status', 0)->count(),
            'product-updated-request' => $products->whereNotNull('is_shipping_cost_updated')->where('is_shipping_cost_updated', 0)->count(),
            'approved' => $products->where('request_status', 1)->count(),
            'denied' => $products->where('request_status', 2)->where('status' , 0)->count(),
        };
    }
}

if (!function_exists('salt_composition')) {
    function salt_composition($id)
    {
        $html = '';
        $molecules = ProductMolecule::where('product_id', $id)->get();

        foreach ($molecules as $index => $molecule) {
            $molecule = Molecule::find($molecule->molecule_id);
            if ($molecule) {
                $html .= '<a target="_blank" href="' . route('single-molecule', $molecule->slug) . '">' . $molecule->name . '</a>';
                // Add a comma after each tag except the last one
                if ($index < $molecules->count() - 1) {
                    $html .= ', ';
                }
            }
        }

        return $html;
    }
}

if (!function_exists('product_indication')) {
    function product_indication($id)
    {
        $html = '<p>Indications:<strong>&nbsp;</strong></p>'; // Initial heading
        $product = Product::find($id);

        if ($product && !empty($product->indication)) {
            $indications = explode(',', $product->indication); // Split indications into an array
            foreach ($indications as $index => $indication) {
                $html .= '<p><strong>' . ($index + 1) . '. ' . e(trim($indication)) . '</strong></p>';
            }
        } else {
            $html .= '<p><strong>No indications available</strong></p>'; // Fallback if no indications exist
        }

        return $html;
    }
}


