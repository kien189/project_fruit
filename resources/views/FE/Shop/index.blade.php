@extends('FE.master')
@section('title', 'Trang mua hàng')
@section('main')
    <base href="/">
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Shop Sidebar</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Shop Main Area Start Here -->
    <div class="shop-main-area">
        <div class="container container-default custom-area">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-12 col-custom widget-mt">
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_3" type="button" class="active btn-grid-3" data-bs-toggle="tooltip"
                                title="3"><i class="fa fa-th"></i></button>
                            <!-- <button data-role="grid_4" type="button"  class=" btn-grid-4" data-bs-toggle="tooltip" title="4"></button> -->
                            <button data-role="grid_list" type="button" class="btn-list" data-bs-toggle="tooltip"
                                title="List"><i class="fa fa-th-list"></i></button>
                        </div>
                        <div class="shop-select">
                            <form class="d-flex flex-column w-100" action="#">
                                <div class="form-group">
                                    <select class="form-control nice-select w-100">
                                        <option selected value="1">Alphabetically, A-Z</option>
                                        <option value="2">Sort by popularity</option>
                                        <option value="3">Sort by newness</option>
                                        <option value="4">Sort by price: low to high</option>
                                        <option value="5">Sort by price: high to low</option>
                                        <option value="6">Product Name: Z</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <!-- Shop Wrapper Start -->
                    <div class="row shop_wrapper grid_3">
                        @foreach ($products as $item)
                            <div class="col-md-6 col-sm-6 col-lg-4 col-custom product-area">
                                <div class="single-product position-relative">
                                    <div class="product-image">
                                        <a class="d-block" href="{{ route('home.detail', $item->slug) }}">
                                            <img src="{{ asset('storage/images/' . $item->image) }}" alt=""
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
                                            <span class="regular-price ">{{ number_format($item->price) }} VND</span>
                                            <span class="old-price"><del>{{ number_format($item->sale_price) }}
                                                    VND</del></span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        @if (auth('customers')->check())
                                            <a title="Thêm vào giỏ hàng" href="{{ route('cart.add', $item) }}"
                                                title="Add To cart">
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
                                            <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')"
                                                title="Thêm vào giỏ hàng" href="{{ route('home.login') }}"
                                                title="Add To cart">
                                                <i class="ion-bag"></i>
                                            </a>
                                            <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')" href="compare.html"
                                                title="Compare">
                                                <i class="ion-ios-loop-strong"></i>
                                            </a>
                                            <a onclick="alert('Vui lòng đăng nhập để thêm yêu thích')" title="Yêu thích"
                                                href="{{ route('home.login') }}" title="Add To Wishlist">
                                                <i class="ion-ios-heart-outline"></i>
                                            </a>
                                            <a onclick="alert('Vui lòng đăng nhập để xem ')"
                                                href="{{ route('home.login') }}" data-bs-toggle="modal"
                                                title="Quick View">
                                                <i class="ion-eye"></i>
                                            </a>
                                        @endif

                                    </div>
                                    <div class="product-content-listview">
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
                                            <span class="regular-price ">{{ number_format($item->price) }} VND</span>
                                            <span class="old-price"><del>{{ number_format($item->sale_price) }}
                                                    VND</del></span>
                                        </div>
                                        <div class="add-action-listview d-flex">
                                            @if (auth('customers')->check())
                                                <a title="Thêm vào giỏ hàng" href="{{ route('cart.add', $item) }}"
                                                    title="Add To cart">
                                                    <i class="ion-bag"></i>
                                                </a>
                                                <a href="compare.html" title="Compare">
                                                    <i class="ion-ios-loop-strong"></i>
                                                </a>

                                                @if ($item->favorite)
                                                    <a title="Bỏ yêu thích"
                                                        onclick="return confirm('Bạn có muốn bỏ yêu thích không ?')"
                                                        href="{{ route('home.favorite', $item) }}"
                                                        title="Add To Wishlist">
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
                                                <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')"
                                                    title="Thêm vào giỏ hàng" href="{{ route('home.login') }}"
                                                    title="Add To cart">
                                                    <i class="ion-bag"></i>
                                                </a>
                                                <a onclick="alert('Vui lòng đăng nhập để thêm giỏ hàng')"
                                                    href="compare.html" title="Compare">
                                                    <i class="ion-ios-loop-strong"></i>
                                                </a>
                                                <a onclick="alert('Vui lòng đăng nhập để thêm yêu thích')"
                                                    title="Yêu thích" href="{{ route('home.login') }}"
                                                    title="Add To Wishlist">
                                                    <i class="ion-ios-heart-outline"></i>
                                                </a>
                                                <a onclick="alert('Vui lòng đăng nhập để xem ')"
                                                    href="{{ route('home.login') }}" data-bs-toggle="modal"
                                                    title="Quick View">
                                                    <i class="ion-eye"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <p class="desc-content">
                                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                            in a
                                            piece of classical Latin literature from 45 BC, making it over 2000 years old.
                                            Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!-- Shop Wrapper End -->
                    <!-- Bottom Toolbar Start -->
                    <div class="row">
                        <div class="col-sm-12 col-custom">
                            <div class="toolbar-bottom mt-30">
                                <nav class="pagination pagination-wrap mb-10 mb-sm-0">
                                    <ul class="pagination">
                                        <!-- Previous Page Link -->
                                        @if ($products->onFirstPage())
                                            <li class="disabled prev">
                                                <span><i class="ion-ios-arrow-thin-left"></i></span>
                                            </li>
                                        @else
                                            <li class="prev">
                                                <a href="{{ $products->previousPageUrl() }}" rel="prev"><i class="ion-ios-arrow-thin-left"></i></a>
                                            </li>
                                        @endif

                                        <!-- Pagination Elements -->
                                        @foreach ($products->links()->elements as $element)
                                            <!-- "Three Dots" Separator -->
                                            @if (is_string($element))
                                                <li class="disabled"><span>{{ $element }}</span></li>
                                            @endif

                                            <!-- Array Of Links -->
                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $products->currentPage())
                                                        <li class="active"><a>{{ $page }}</a></li>
                                                    @else
                                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($products->hasMorePages())
                                            <li class="next">
                                                <a href="{{ $products->nextPageUrl() }}" rel="next"><i class="ion-ios-arrow-thin-right"></i></a>
                                            </li>
                                        @else
                                            <li class="disabled next">
                                                <span><i class="ion-ios-arrow-thin-right"></i></span>
                                            </li>
                                        @endif
                                    </ul>

                                </nav>
                                <p class="desc-content text-center text-sm-right">
                                   Hiển thị {{ $products->firstItem() }} - {{ $products->lastItem() }} của {{ $products->total() }} sản phẩm
                                </p>

                            </div>
                        </div>
                    </div>
                    <!-- Bottom Toolbar End -->
                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget widget-mt">
                        <div class="widget_inner">
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Search</h3>
                                <div class="search-box">
                                    <form action="{{ route('shop.search') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Our Store"
                                                aria-label="Search Our Store" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Menu Categories</h3>
                                <!-- Widget Menu Start -->
                                <nav>
                                    <ul class="mobile-menu p-0 m-0">
                                        <li class="menu-item-has-children"><a href="#">Breads</a>
                                            @foreach ($CategoryHome as $item)
                                                <ul class="dropdown">
                                                    <li><a href="{{ route('shop.Cate', $item->id) }}">{{ $item->name }}
                                                            ({{ $item->products->count() }})
                                                        </a></li>
                                                </ul>
                                            @endforeach
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Fruits</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Samsome</a></li>
                                                <li><a href="#">GL Stylus (4)</a></li>
                                                <li><a href="#">Uawei (3)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Vagetables</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Power Bank</a></li>
                                                <li><a href="#">Data Cable (4)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                                <li><a href="#">Brocoly (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Organic Food</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Vagetables</a></li>
                                                <li><a href="#">Green Food (4)</a></li>
                                                <li><a href="#">Coconut (3)</a></li>
                                                <li><a href="#">Cabage (3)</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- Widget Menu End -->
                            </div>
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Categories</h3>
                                <div class="sidebar-body">
                                    <ul class="sidebar-list">
                                        <li><a href="#">All Product</a></li>
                                        <li><a href="#">Best Seller (5)</a></li>
                                        <li><a href="#">Featured (4)</a></li>
                                        <li><a href="#">New Products (6)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-list widget-mb-2">
                                <h3 class="widget-title">Color</h3>
                                <div class="sidebar-body">
                                    <div class="sidebar-list">
                                        <button type="button" class="btn red"></button>
                                        <button type="button" class="btn green"></button>
                                        <button type="button" class="btn blue"></button>
                                        <button type="button" class="btn yellow"></button>
                                        <button type="button" class="btn white"></button>
                                        <button type="button" class="btn gold"></button>
                                        <button type="button" class="btn gray"></button>
                                        <button type="button" class="btn magenta"></button>
                                        <button type="button" class="btn maroon"></button>
                                        <button type="button" class="btn navy"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-list widget-mb-3">
                                <h3 class="widget-title">Tags</h3>
                                <div class="sidebar-body">
                                    <ul class="tags">
                                        <li><a href="#">Car</a></li>
                                        <li><a href="#">Parts</a></li>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="#">Tayer</a></li>
                                        <li><a href="#">Seat</a></li>
                                        <li><a href="#">Engine</a></li>
                                        <li><a href="#">Parts</a></li>
                                        <li><a href="#">Fuel</a></li>
                                        <li><a href="#">Modern</a></li>
                                        <li><a href="#">Brake</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-list widget-mb-4">
                                <h3 class="widget-title">Sản phẩm mới</h3>
                                <div class="sidebar-body">
                                    <div class="sidebar-product align-items-center">
                                        <a href="product-details.html" class="image">
                                            <img src="assets/images/product/small-product/1.jpg" alt="product">
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="product-details.html">Product dummy name</a>
                                                </h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price ">$80.00</span>
                                                <span class="old-price"><del>$90.00</del></span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-product align-items-center">
                                        <a href="product-details.html" class="image">
                                            <img src="assets/images/product/small-product/2.jpg" alt="product">
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="product-details.html">Product dummy
                                                        title</a></h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price ">$50.00</span>
                                                <span class="old-price"><del>$60.00</del></span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-product align-items-center">
                                        <a href="product-details.html" class="image">
                                            <img src="assets/images/product/small-product/3.jpg" alt="product">
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="product-details.html">Product title here</a>
                                                </h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price ">$40.00</span>
                                                <span class="old-price"><del>$50.00</del></span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- Sidebar Widget End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Main Area End Here -->
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
    <!-- Support Area End Here -->
@endsection
