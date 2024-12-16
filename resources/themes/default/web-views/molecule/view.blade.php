@extends('layouts.front-end.app')

@section('title',translate('molecule'))

@push('css_or_js')
    <meta property="og:image" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="og:title" content="Blogs of {{$web_config['name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="twitter:title" content="Blogs of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <style>
        .breadcrumb{
    display: inline-block;
    padding: 0;
    margin: 0;
    border-radius: 5px 25px 25px 5px;
    overflow: hidden;
}
.breadcrumb :hover{
    text-decoration: none;
}
.breadcrumb li{
    float: left;
    margin-right: 3px;
    position: relative;
    z-index: 1;
}
.breadcrumb li:before{ display: none; }
.breadcrumb li:after{
    content: "";
    width: 40px;
    height: 100%;
    background: #428dff;
    position: absolute;
    top: 0;
    right: -20px;
    z-index: -1;
}
.breadcrumb li:nth-last-child(2):after,
.breadcrumb li:last-child:after{ display: none; }
.breadcrumb li a,
.breadcrumb li:last-child{
    display: block;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    border-radius: 0 25px 25px 0;
    box-shadow: 5px 0 5px -5px #333;
}
.breadcrumb li a{ background: #428dff; }
.breadcrumb li:last-child{
    background: #ebf3fe;
    color: #428dff;
    margin-right: 0;
}
@media only screen and (max-width: 479px){
    .breadcrumb li a,
    .breadcrumb li:last-child{ padding: 8px 10px; }
}
@media only screen and (max-width: 359px){
    .breadcrumb li a,
    .breadcrumb li:last-child{ padding: 8px 7px; }
}
    </style>

@endpush

@section('content')
<div class="container mt-3 mb-3">
    <div class="row pad-15">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">{{ $molecule->tag }}</a></li>
                <li style="display: none"><a href="#"></a></li>
            </ol>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="mt-3 blog-description" >{!! $molecule->description !!}</div>
        </div>
        <div class="col-12 mt-5 mb-3">
            <h4>Frequently Asked Questions</h4>
            <div class="accordion" id="accordionExample">
                @forelse ($faqs as $faq)
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ $faq->question }}
                      </button>
                    </h2>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      {{ $faq->answer ?? '' }}
                    </div>
                  </div>
                </div>
                @empty
                <p>No data found!</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection

@push('script')


@endpush
