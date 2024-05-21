@extends('FE.master')

@section('main')
    <base href="/">

    <div class="product-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Tìm thấy {{$products->count()}}  kết quả với từ khóa "{{$searchTerm}}"</h2>
                        <div class="desc-content">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>

            @php $chunked_products = $products->chunk(4); @endphp
            @foreach ($chunked_products as $chunk)
                <div class="row">
                    @foreach ($chunk as $item)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product position-relative mb-30">
                                <div class="product-image">
                                    <a class="d-block" href="product-details.html">
                                        <img src="{{ asset('storage/images') }}/{{ $item->image }}" alt=""
                                            class="product-image-1 w-100">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="product-title">
                                        <h4 class="title-2"> <a
                                                href="{{ route('home.detail', $item->slug) }}">{{ $item->name }}</a>
                                        </h4>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">{{ number_format($item->price) }}VND</span>
                                        <span
                                            class="old-price"><del>{{ number_format($item->sale_price) }}VND</del></span>
                                    </div>
                                </div>
                                <div class="add-action d-flex position-absolute">
                                    @if (auth('customers')->check())
                                        <a title="Thêm vào giỏ hàng" href="{{route('cart.add',$item)}}" title="Add To cart">
                                            <i class="ion-bag"></i>
                                        </a>
                                        <a href="compare.html" title="Compare">
                                            <i class="ion-ios-loop-strong"></i>
                                        </a>

                                        @if ($item->favorite)
                                            <a title="Bỏ yêu thích"
                                                onclick="return confirm('Bạn có muốn bỏ yêu thích không ?')"
                                                href="{{ route('home.favorite', $item) }}" title="Add To Wishlist">
                                                <i class="fa-solid fa-heart" style="color: #bd144a;"></i>
                                            </a>
                                        @else
                                            <a title="Yêu thích" href="{{ route('home.favorite', $item) }}"
                                                title="Add To Wishlist">
                                                <i class="ion-ios-heart-outline"></i>
                                            </a>
                                        @endif
                                        <a href="#exampleModalCenter" data-bs-toggle="modal" title="Quick View">
                                            <i class="ion-eye"></i>
                                        </a>
                                    @else
                                        <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')" title="Thêm vào giỏ hàng" href="{{route('home.login')}}" title="Add To cart">
                                            <i class="ion-bag"></i>
                                        </a>
                                        <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')" href="compare.html" title="Compare">
                                            <i class="ion-ios-loop-strong"></i>
                                        </a>
                                        <a onclick="alert('Vui lòng đăng nhập để thêm yêu thích')" title="Yêu thích" href="{{route('home.login')}}"
                                            title="Add To Wishlist">
                                            <i class="ion-ios-heart-outline"></i>
                                        </a>
                                        <a onclick="alert('Vui lòng đăng nhập để xem ')" href="{{route('home.login')}}" data-bs-toggle="modal" title="Quick View">
                                            <i class="ion-eye"></i>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
    <div class="latest-blog-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Latest Blog</h2>
                        <div class="desc-content">
                            <p>If you want to know about the organic product then keep an eye on our blog.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-custom">
                    <div class="obrien-slider"
                        data-slick-options='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": true,
                "arrows": false,
                "dots": false
                }'
                        data-slick-responsive='[
                {"breakpoint": 1200, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint": 992, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint": 768, "settings": {
                "slidesToShow": 1
                }},
                {"breakpoint": 576, "settings": {
                "slidesToShow": 1
                }}
                ]'>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/1.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/2.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/3.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">The Standard Chunk Of Lorem Ipsum Used Since</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/4.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <div class="support-wrapper d-flex">
                        <div class="support-content">
                            <h1 class="title">Need Help ?</h1>
                            <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                        </div>
                        <div class="support-button d-flex align-items-center">
                            <a class="obrien-button primary-btn" href="contact-us.html">Contact now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
