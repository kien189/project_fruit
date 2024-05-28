@extends('FE.master')
@section('main')
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Product Details</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Single Product Main Area Start -->
    <div class="single-product-main-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 col-custom">
                    <div class="product-details-img horizontal-tab">
                        <div class="product-slider popup-gallery product-details_slider"
                            data-slick-options='{
                "slidesToShow": 1,
                "arrows": false,
                "fade": true,
                "draggable": false,
                "swipe": false,
                "asNavFor": ".pd-slider-nav"
                }'>
                            @foreach ($product->images as $item)
                                <div class="single-image border">
                                    <a href="{{ asset('storage/images') }}/images/product/large-size/1.jpg">
                                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="Product">
                                    </a>
                                </div>
                            @endforeach
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/1.jpg">
                                    <img src="{{ asset('assets') }}/images/product/large-size/1.jpg" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/2.png">
                                    <img src="{{ asset('assets') }}/images/product/large-size/2.png" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/3.png">
                                    <img src="{{ asset('assets') }}/images/product/large-size/3.png" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/4.jpg">
                                    <img src="{{ asset('assets') }}/images/product/large-size/4.jpg" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/5.png">
                                    <img src="{{ asset('assets') }}/images/product/large-size/5.png" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/6.png">
                                    <img src="{{ asset('assets') }}/images/product/large-size/6.png" alt="Product">
                                </a>
                            </div>
                            <div class="single-image border">
                                <a href="{{ asset('assets') }}/images/product/large-size/7.png">
                                    <img src="{{ asset('assets') }}/images/product/large-size/7.png" alt="Product">
                                </a>
                            </div>
                        </div>
                        <div class="pd-slider-nav product-slider"
                            data-slick-options='{
                "slidesToShow": 4,
                "asNavFor": ".product-details_slider",
                "focusOnSelect": true,
                "arrows" : false,
                "spaceBetween": 30,
                "vertical" : false
                }'
                            data-slick-responsive='[
                    {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                    {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                    {"breakpoint":992, "settings": {"slidesToShow": 4}},
                    {"breakpoint":575, "settings": {"slidesToShow": 3}}
                ]'>
                            @foreach ($product->images as $item)
                                <div class="single-thumb border">
                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="Product Thumnail lỗi">
                                </div>
                            @endforeach
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/2.png" alt="Product Thumnail">
                            </div>
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/3.png" alt="Product Thumnail">
                            </div>
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/4.png" alt="Product Thumnail">
                            </div>
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/5.png" alt="Product Thumnail">
                            </div>
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/6.png" alt="Product Thumnail">
                            </div>
                            <div class="single-thumb border">
                                <img src="{{ asset('assets') }}/images/product/small-size/7.png" alt="Product Thumnail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-custom">
                    <div class="product-summery position-relative">
                        <div class="product-head mb-3">
                            <h2 class="product-title">{{ $product->name }}</h2>
                        </div>
                        <div class="price-box mb-2 d-flex align-items-center ">
                            @if (isset($selectedVariant))
                                <span class="regular-price">
                                    <p>{{ number_format($selectedVariant->price) }} đ </p>
                                </span>
                                <span
                                    class="old-price"><del>{{ number_format($selectedVariant->sale_price) }}đ</del></span>
                            @endif
                        </div>
                        <div class="product-rating mb-3">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="sku mb-5">
                            <span>Danh mục: <a href="">{{ $product->category->name }}</a></span>
                        </div>
                        <p class="desc-content mb-3">{!! $product->description !!}</p> <br>
                        <div class="mb-4">


                            <form action="{{ route('home.updatePrice', $product->slug) }}" method="POST">
                                @csrf
                                <!-- Nút ẩn để xác định kích thước mặc định -->
                                {{-- <input type="hidden" name="default_size" value="{{ $selectedVariant->size }}"> --}}

                                <div>
                                    @foreach ($product->variants as $variant)
                                        <input class="p-2 border rounded-pill  " type="submit" class="me-3"
                                            name="size" value="{{ $variant->size }}">
                                    @endforeach
                                </div>
                            </form>
                        </div>
                        <div class="quantity-with_btn mb-4">
                            <div class="quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="1" type="text" name="quantity">
                                    <div class="dec qtybutton">-</div>
                                    <div class="inc qtybutton">+</div>
                                </div>
                            </div>
                            @if (auth('customers')->check())
                                <div class="add-to_cart">
                                    <a class="btn obrien-button primary-btn" href="{{ route('cart.add', $product) }}">Add
                                        to
                                        cart</a>
                                    <a class="btn obrien-button-2 treansparent-color pt-0 pb-0"
                                        href="{{ route('home.favorite', $product) }}">Add to
                                        wishlist</a>
                                </div>
                            @else
                                <div class="add-to_cart">
                                    <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')" title="Thêm vào giỏ hàng"
                                        href="{{ route('home.login') }}" class="btn obrien-button primary-btn">Add
                                        to cart</a>
                                    <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')"
                                        class="btn obrien-button-2 treansparent-color pt-0 pb-0"
                                        href="{{ route('home.login') }}">Thêm vào yêu thích</a>
                                </div>
                            @endif

                        </div>
                        <div class="buy-button mb-5">
                            <a href="#" class="btn obrien-button-3 black-button">Buy it now</a>
                        </div>



                        <div class="social-share mb-4">
                            <span>Share :</span>
                            <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                            <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                            <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                            <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                        </div>
                        <div class="payment">
                            <a href="#"><img class="border"
                                    src="{{ asset('assets') }}/images/payment/img-payment.png" alt="Payment"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-no-text">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab"
                                href="#connect-1" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#connect-2"
                                role="tab" aria-selected="false">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3"
                                role="tab" aria-selected="false">Shipping Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4"
                                role="tab" aria-selected="false">Size Chart</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-text" id="myTabContent">
                        <div class="tab-pane fade show active" id="connect-1" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="desc-content">
                                <p class="mb-3">On the other hand, we denounce with righteous indignation and dislike
                                    men
                                    who are so beguiled and demoralized by the charms of pleasure of the moment, so
                                    blinded
                                    by desire, that they cannot foresee the pain and trouble that are bound to ensue;
                                    and
                                    equal blame belongs to those who fail in their duty through weakness of will, which
                                    is
                                    the same as saying through shrinking from toil and pain. These cases are perfectly
                                    simple and easy to distinguish. In a free hour, when our power of choice is
                                    untrammelled
                                    and when nothing prevents our being able to do what we like best, every pleasure is
                                    to
                                    be welcomed and every pain avoided. But in certain circumstances and owing to the
                                    claims
                                    of duty or the obligations of business it will frequently occur that pleasures have
                                    to
                                    be repudiated and annoyances accepted. The wise man therefore always holds in these
                                    matters to this principle of selection: he rejects pleasures to secure other greater
                                    pleasures, or else he endures pains to avoid worse pains.</p>
                                <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                                    soluta
                                    nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat
                                    facere
                                    possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem
                                    quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et
                                    voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic
                                    tenetur
                                    a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut
                                    perferendis doloribus asperiores repellat.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- Start Single Content -->
                            <div class="product_tab_content  border p-3">
                                <div class="review_address_inner">
                                    <!-- Start Single Review -->
                                    @foreach ($comments as $item)
                                        <div class="pro_review mb-5">
                                            <div class="review_thumb">
                                                <img alt="review images" src="{{ asset('assets') }}/images/review/1.jpg">
                                            </div>
                                            <div class="review_details">
                                                <div class="review_info mb-2">
                                                    <div class="product-rating mb-2">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>

                                                    <h5>{{ $item->customers->name }} -
                                                        <span>{{ $item->created_at->format('d/m/Y') }} </span>
                                                    </h5>
                                                </div>
                                                <p>{{ $item->comment }}.</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- End Single Review -->

                                </div>
                                <!-- Start RAting Area -->
                                <div class="rating_wrap">
                                    <h5 class="rating-title-1 mb-2">Add a review </h5>
                                    <p class="mb-2">Your email address will not be published. Required fields are
                                        marked
                                        *</p>
                                    <h6 class="rating-title-2 mb-2">Your Rating</h6>
                                    <div class="rating_list mb-4">
                                        <div class="review_info">
                                            <div class="product-rating mb-3">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End RAting Area -->
                                <div class="comments-area comments-reply-area">
                                    <div class="row">
                                        @if (Auth::guard('customers')->check())
                                            <div class="col-lg-12 col-custom">
                                                <form action="{{ route('comments', $product->id) }}" method="post"
                                                    class="comment-form-area">
                                                    @csrf
                                                    {{-- <div class="row comment-input">
                                                    <div class="col-md-6 col-custom comment-form-author mb-3">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" required="required" name="Name">
                                                    </div>
                                                    <div class="col-md-6 col-custom comment-form-emai mb-3">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input type="text" required="required" name="email">
                                                    </div>
                                                </div> --}}
                                                    <div class="comment-form-comment mb-3">
                                                        <label>Comment</label>
                                                        <textarea class="comment-notes" name="comment"></textarea>
                                                    </div>
                                                    <div class="comment-form-submit">
                                                        <input type="submit" value="Submit"
                                                            class="comment-submit btn obrien-button primary-btn">
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="alert alert-danger " role="alert">
                                                <strong>Đăng nhập để bình luận </strong> Click vào đây <a
                                                    href="{{ route('home.login') }}">Đăng nhập</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                        <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="shipping-policy">
                                <h4 class="title-3 mb-4">Shipping policy for our store</h4>
                                <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                    sed
                                    diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                    Ut
                                    wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                                    nisl
                                    ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
                                    vulputate</p>
                                <ul class="policy-list mb-2">
                                    <li>1-2 business days (Typically by end of day)</li>
                                    <li><a href="#">30 days money back guaranty</a></li>
                                    <li>24/7 live support</li>
                                    <li>odio dignissim qui blandit praesent</li>
                                    <li>luptatum zzril delenit augue duis dolore</li>
                                    <li>te feugait nulla facilisi.</li>
                                </ul>
                                <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue
                                    nihil
                                    imperdiet doming id quod mazim placerat facer possim assum. Typi non habent
                                    claritatem
                                    insitam; est usus legentis in iis qui facit eorum</p>
                                <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores
                                    legere me
                                    lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur
                                    mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc
                                    putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                                <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi,
                                    qui
                                    nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                            <div class="size-tab table-responsive-lg">
                                <h4 class="title-3 mb-4">Size Chart</h4>
                                <table class="table border">
                                    <tbody>
                                        <tr>
                                            <td class="cun-name"><span>UK</span></td>
                                            <td>18</td>
                                            <td>20</td>
                                            <td>22</td>
                                            <td>24</td>
                                            <td>26</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>European</span></td>
                                            <td>46</td>
                                            <td>48</td>
                                            <td>50</td>
                                            <td>52</td>
                                            <td>54</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>usa</span></td>
                                            <td>14</td>
                                            <td>16</td>
                                            <td>18</td>
                                            <td>20</td>
                                            <td>22</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>Australia</span></td>
                                            <td>28</td>
                                            <td>10</td>
                                            <td>12</td>
                                            <td>14</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>Canada</span></td>
                                            <td>24</td>
                                            <td>18</td>
                                            <td>14</td>
                                            <td>42</td>
                                            <td>36</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product Main Area End -->
    <!-- Product Area Start Here -->
    <div class="product-area mb-text">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Related Product</h2>
                        <div class="desc-content">
                            <p>You can check the related product for your shopping collection.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 product-wrapper col-custom">
                    <div class="product-slider"
                        data-slick-options='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "infinite": true,
                "arrows": false,
                "dots": false
                }'
                        data-slick-responsive='[
                {"breakpoint": 1200, "settings": {
                "slidesToShow": 3
                }},
                {"breakpoint": 992, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint": 576, "settings": {
                "slidesToShow": 1
                }}
                ]'>
                        @foreach ($related as $item)
                            <div class="single-item">
                                <div class="single-product position-relative">
                                    <div class="product-image">
                                        <a class="d-block" href="product-details.html">
                                            <img src="{{ asset('storage/images/', $item->image) }}" alt="LỖi"
                                                class="product-image-1 w-100">
                                            {{-- <img src="{{ asset('assets') }}/images/product/2.jpg" alt=""
                                                class="product-image-2 position-absolute w-100"> --}}
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
                                            <h4 class="title-2"> <a href="product-details.html">{{ $item->name }}</a>
                                            </h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">
                                                {{ number_format($item->variants->isNotEmpty() ? $item->variants->first()->price : 0) }}đ</span>
                                            <span class="old-price"><del>
                                                    {{ number_format($item->variants->isNotEmpty() ? $item->variants->first()->sale_price : 0) }}đ</del></span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        <a href="cart.html" title="Add To cart">
                                            <i class="ion-bag"></i>
                                        </a>
                                        <a href="compare.html" title="Compare">
                                            <i class="ion-ios-loop-strong"></i>
                                        </a>
                                        <a href="wishlist.html" title="Add To Wishlist">
                                            <i class="ion-ios-heart-outline"></i>
                                        </a>
                                        <a href="#exampleModalCenter" data-bs-toggle="modal" title="Quick View">
                                            <i class="ion-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Product Area Start Here -->
    <div class="product-area mb-no-text">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">You May Also Like</h2>
                        <div class="desc-content">
                            <p>Most of the customers choose our products. You may also like our product.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 product-wrapper col-custom">
                    <div class="product-slider"
                        data-slick-options='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "infinite": true,
                "arrows": false,
                "dots": false
                }'
                        data-slick-responsive='[
                {"breakpoint": 1200, "settings": {
                "slidesToShow": 3
                }},
                {"breakpoint": 992, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint": 576, "settings": {
                "slidesToShow": 1
                }}
                ]'>
                        @foreach ($mayalsolike as $item)
                            <div class="single-item">
                                <div class="single-product position-relative">
                                    <div class="product-image">
                                        <a class="d-block" href="product-details.html">
                                            <img src="{{ asset('storage/images/', $item->image) }}" alt=""
                                                class="product-image-1 w-100">
                                            {{-- <img src="{{ asset('assets') }}/images/product/2.jpg" alt=""
                                                class="product-image-2 position-absolute w-100"> --}}
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
                                            <h4 class="title-2"> <a href="product-details.html">{{ $item->name }}</a>
                                            </h4>
                                        </div>
                                        <div class="price-box">
                                            <span
                                                class="regular-price ">{{ number_format($item->variants->isNotEmpty() ? $item->variants->first()->price : 0) }}đ</span>
                                            <span
                                                class="old-price"><del>{{ number_format($item->variants->isNotEmpty() ? $item->variants->first()->sale_price : 0) }}đ</del></span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        <a href="cart.html" title="Add To cart">
                                            <i class="ion-bag"></i>
                                        </a>
                                        <a href="compare.html" title="Compare">
                                            <i class="ion-ios-loop-strong"></i>
                                        </a>
                                        <a href="wishlist.html" title="Add To Wishlist">
                                            <i class="ion-ios-heart-outline"></i>
                                        </a>
                                        <a href="#exampleModalCenter" data-bs-toggle="modal" title="Quick View">
                                            <i class="ion-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Support Area Start Here -->
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
{{-- @section('varaints')
    <script>
        // Định nghĩa hàm updatePrice để cập nhật giá sản phẩm dựa trên kích thước đã chọn
        function updatePrice(size) {
            // Lấy ra phần tử hiển thị giá từ DOM
            var priceDisplay = document.getElementById("priceDisplay");
            // Lấy dữ liệu về biến thể sản phẩm từ biến PHP đã truyền vào và chuyển đổi thành một mảng JavaScript
            var variants = @json($items);
            // Tìm kiếm biến thể sản phẩm có kích thước tương ứng và gán giá cho phần tử hiển thị giá
            var selectedVariant = variants.find(variant => variant.size === size);
            priceDisplay.innerText = selectedVariant ? selectedVariant.price : "N/A";
        }


        // Định nghĩa hàm selectSize để chọn kích thước và cập nhật giá
        function selectSize(size) {
            // Lấy ra tất cả các nút kích thước từ DOM
            var buttons = document.querySelectorAll('button.size-button');
            // Loại bỏ lớp 'active' từ tất cả các nút kích thước
            buttons.forEach(button => button.classList.remove('active'));
            // Tìm nút kích thước đã chọn dựa trên kích thước và thêm lớp 'active'
            var selectedButton = document.getElementById(`size-${size}`);
            if (!selectedButton.classList.contains('active')) {
                /*
                 Đây là một điều kiện if. Nó kiểm tra xem nút kích thước đã chọn có chứa lớp 'active' không.
                  Nếu không, điều kiện này trả về true. Dấu chấm than . là một cách để truy cập vào danh sách
                  các lớp CSS của phần tử HTML, và phương thức contains() kiểm tra xem danh sách đó có chứa một
                  lớp cụ thể ('active' trong trường hợp này) hay không.
                 Dấu ! ở đầu điều kiện là toán tử phủ định, nên nếu phần tử không có lớp 'active', điều kiện sẽ trả về true.
                */
                selectedButton.classList.add('active');
                /*
                Nếu điều kiện trên là true, tức là nút kích thước chưa được chọn,
                lệnh này sẽ thêm lớp 'active' vào nút đó. Phương thức add() của đối tượng
                 classList được sử dụng để thêm một lớp mới vào phần tử HTML.
                */
            }
            // Gọi hàm updatePrice để cập nhật giá khi kích thước được chọn thay đổi
            updatePrice(size);
        }
    </script>
    <style>
        .option-button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .option-button.active {
            background-color: #007bff;
            color: white;
        }
    </style>

    <script>
        // Hàm này được gọi khi trang web được tải lần đầu tiên
        window.onload = function() {
            // Lấy ra nút kích thước đầu tiên từ DOM
            var firstSizeButton = document.querySelector('button.size-button');
            // Nếu tồn tại nút kích thước đầu tiên
            if (firstSizeButton) {
                // Thêm lớp 'active' cho nút kích thước đầu tiên
                firstSizeButton.classList.add('active');
                // Gọi hàm updatePrice để cập nhật giá khi trang web được tải lần đầu tiên
                updatePrice(firstSizeButton.dataset.size);
            }
        }
    </script>
@endsection --}}
