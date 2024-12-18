@extends('layouts.front-end.app')

@section('title', translate('my_Prescriptions'))

@push('css_or_js')
    <link rel="stylesheet"
        href="{{ theme_asset(path: 'public/assets/front-end/vendor/nouislider/distribute/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet"
        href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
@endpush

@section('content')
    <div class="__account-address">

        <div class="container py-2 py-md-4 p-0 p-md-2 user-profile-container px-5px">
            <div class="row ">
                @include('web-views.partials._profile-aside')
                <section class="col-lg-9 __customer-profile customer-profile-wishlist px-0">
                    <div class="card __card d-none d-lg-flex web-direction customer-profile-prescriptions h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-0 mb-md-3">
                                <h5 class="font-bold mb-0 fs-16">{{ translate('my_Prescriptions') }}</h5>
                            </div>

                            <div class="container">
                                <div class="portfolio-item row">
                                    @if ($prescriptions->count() > 0)
                                        @foreach ($prescriptions as $prescription)
                                            <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                                                @php
                                                    $fileExtension = pathinfo($prescription->file, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($fileExtension), [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'bmp',
                                                        'webp',
                                                    ]);
                                                @endphp
                                                <a href="{{ asset('public/storage/' . $prescription->file) }}"
                                                    class="">
                                                    @if ($isImage)
                                                        <img class="img-fluid"
                                                            src="public/assets/front-end/img/default-image.jpg"
                                                            alt="Prescription">
                                                    @else
                                                        <img class="img-fluid"
                                                            src="{{ asset('public/assets/front-end/img/default-pdf-img.webp') }}" width="150"
                                                            alt="Default PDF">
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex justify-content-center align-items-center h-100">
                                            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/empty-icons/empty-prescriptions.svg') }}"
                                                    alt="" width="100">
                                                <h5 class="text-muted fs-14 font-semi-bold text-center">
                                                    {{ translate('You_have_not_any_prescription_yet') }}!</h5>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>


                            {{-- <div class="card-footer border-0">
                                {{$prescriptions->links() }}
                            </div> --}}
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

    <script>
        $('.portfolio-menu ul li').click(function() {
            $('.portfolio-menu ul li').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $('.portfolio-item').isotope({
                filter: selector
            });
            return false;
        });
        $(document).ready(function() {
            var popup_btn = $('.popup-btn');
            popup_btn.magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
@endpush
