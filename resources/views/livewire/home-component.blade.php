<div>
    <main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="{{asset('frontend/assets/images/main-slider-1-1.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">Kid Smart <b>Watches</b></h2>
							<span class="subtitle">Compra todos tus productos Smart por internet.</span>
							<p class="sale-info">Only price: <span class="price">$59.99</span></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{asset('frontend/assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{asset('frontend/assets/images/main-slider-1-3.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{asset('frontend/assets/images/home-1-banner-1.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{asset('frontend/assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			@if ( $on_sale_products->count() > 0 && $sale->status == 1 && $sale->sale_time > Carbon\Carbon::now() )			
				<div class="wrap-show-advance-info-box style-1 has-countdown">
					<h3 class="title-box">On Sale</h3>
					<div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_time)->format('Y/m/d h:m:s') }}">
					</div>
					<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

						@foreach ($on_sale_products as $on_sale_product)
						<div class="product product-style-2 equal-elem ">
							<div class="product-thumnail">
								<a href="{{route('product.details', $on_sale_product->slug)}}">
									<figure>
										<img src="{{asset('storage/media/products/' .$on_sale_product->image)}}" width="800" height="800" alt="{{$on_sale_product->name}}">
									</figure>
								</a>
								<div class="group-flash">
									<span class="flash-item sale-label">sale</span>
								</div>
								<div class="wrap-btn">
									<a href="#" class="function-link">quick view</a>
								</div>
							</div>
							<div class="product-info">
								<a href="{{route('product.details', $on_sale_product->slug)}}" class="product-name">
									<span> {{$on_sale_product->name}} </span>
								</a>
								<div class="wrap-price">
									<span class="product-price">
										${{$on_sale_product->sale_price}}
									</span>
									<div  class="product-price" style="margin-left: 10px">
										<del>${{$on_sale_product->regular_price}}</del>
									</div>
								</div>
							</div>
						</div>
						@endforeach

					</div>
				</div>
			@endif

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure>
							<img src="{{asset('frontend/assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt="">
						</figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

								@foreach ($latest_products as $latest_product)
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{ route('product.details', $latest_product->slug)}}">
												<figure>
													<img src="{{asset('storage/media/products/' .$latest_product->image)}}" alt="{{$latest_product->slug}}" width="800" height="800">
												</figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{ route('product.details', $latest_product->slug)}}" class="product-name">
												<span> {{ $latest_product->name }} </span>
												</a>
											<div class="wrap-price">
												<span class="product-price"> ${{ $latest_product->regular_price }}
												</span>
											</div>
										</div>
									</div>
									@endforeach
									
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure>
							<img src="{{asset('frontend/assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt="">
						</figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">

							@foreach ($categories as $key=>$category)
							<a href="#category-{{$category->id}}" class="tab-control-item {{$key == 0 ? 'active' : ''}} ">
								 {{  $category->name }} 
							</a>
							@endforeach
							
						</div>
						<div class="tab-contents">

						@foreach ($categories as $key=>$category)
							<div class="tab-content-item {{$key == 0 ? 'active' : ''}} " id="category-{{$category->id}}">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

									@foreach ($category->products as $product)
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{route('product.details', $product->slug)}}">
												<figure>
													<img src="{{asset('storage/media/products/' .$product->image)}}" width="800" height="800" alt="{{$product->slug}}">
												</figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{route('product.details', $product->slug)}}" class="product-name">
												<span>{{$product->name}}</span>
											</a>
											<div class="wrap-price">
												<span class="product-price">${{$product->regular_price}}</span>
											</div>
										</div>
									</div>
									@endforeach

								</div>
							</div>
						@endforeach

						</div>
					</div>
				</div>
			</div>			

		</div>

	</main>
</div>
