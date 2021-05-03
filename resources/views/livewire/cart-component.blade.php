<div>
	<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>

			<div class=" main-content-area">
			@if (Cart::instance('cart')->count() > 0)
				<div class="wrap-iten-in-cart">
					@if (Session::has('success'))
						<div class="alert alert-success">
							<strong>Success!</strong> {{Session::get('success')}}
						</div>
					@endif

					<h3 class="box-title">Products Name</h3>
					<ul class="products-cart">

						@foreach (Cart::instance('cart')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('storage/media/products/' .$item->model->image)}}" alt="{{ $item->model->slug }}">
								</figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{ route('product.details', $item->model->slug)}}"> {{ $item->model->name }} </a>
							</div>
							<div class="price-field produtc-price">
								@if ($item->model->sale_price>0 && $sale->status == 1 && $sale->sale_time > Carbon\Carbon::now())
								<p class="price"> $ {{ $item->model->sale_price }} </p>
								@else
								<p class="price"> $ {{ $item->model->regular_price }} </p>
								@endif
							</div>

							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="qty" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*">									
									<a class="btn btn-increase" wire:click.prevent="increaseCartQuantity('{{$item->rowId}}')">
									</a>
									<a class="btn btn-reduce" wire:click.prevent="decreaseCartQuantity('{{$item->rowId}}')">
									</a>
								</div>
								<p>
									<a href="javascript:void(0)" wire:click.prevent="switchToSaveForLater('{{$item->rowId}}')">
										Save For Later
									</a>
								</p>
							</div>

							<div class="price-field sub-total">
								{{-- $item->subtotal --}}
								<p class="price">${{ $item->subtotal }}</p>
							</div>
							<div class="delete">
								<a class="btn btn-delete" title="Delete" wire:click.prevent="destroy('{{$item->rowId}}')">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle"></i>
								</a>
							</div>
						</li>			
						@endforeach

					</ul>
				</div>

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Order Summary</h4>
						<p class="summary-info">
							<span class="title">Subtotal</span>
							<b class="index">$ {{ Cart::subtotal() }} </b>
						</p>
					@if ( Session::has('coupon') )
						<p class="summary-info">
								<span class="title">Discount ({{Session::get('coupon')['code']}}) </span> <a href="#" wire:click.prevent="removeCoupon" class="text-danger">Cancel</a>
								<b class="index"> - ${{number_format($discount, 2)}} </b>
						</p>
						<p class="summary-info">
								<span class="title">Subtotal With Discount</span>
								<b class="index">$ {{number_format($subtotal_after_discount, 2)}}  </b>
						</p>
						<p class="summary-info">
								<span class="title">Tax ({{config('cart.tax')}}%) </span>
								<b class="index">$ {{number_format($tax_after_discount, 2)}} </b>
						</p>
						<p class="summary-info">
								<span class="title">Shipping</span>
								<b class="index">Free Shipping</b>
						</p>
						<p class="summary-info total-info ">
								<span class="title">Total</span>
								<b class="index">$ {{number_format($total_after_discount, 2)}} </b>
						</p>
						@else 
							<p class="summary-info">
								<span class="title">Tax ({{config('cart.tax')}}%) </span>
								<b class="index">$ {{ Cart::tax() }} </b>
							</p>
							<p class="summary-info">
								<span class="title">Shipping</span>
								<b class="index">Free Shipping</b>
							</p>
							<p class="summary-info total-info ">
								<span class="title">Total</span>
								<b class="index">$ {{ Cart::total() }} </b>
							</p>
					@endif
					</div>

					<div class="checkout-info">

					@if ( !Session::has('coupon'))
						<label class="checkbox-field">
							<input class="frm-input" name="have-code" value="1" wire:model="haveCouponCode" type="checkbox">
							<span>I have coupon code</span>
						</label>

						@if ( $haveCouponCode == 1 )
						<div class="summary-item">
							<form wire:submit.prevent="applyCouponCode">
								<h4> Coupon Code </h4>
								@if (Session::has('coupon_message'))
									<div class="alert alert-danger">
										 {{Session::get("coupon_message")}} 
								</div>
								@endif
								<p class="row-in-form">
									<input type="text" wire:model="applyCode" placeholder="Enter your coupon code">
								@error('applyCode')
									<div class="text-danger">{{$message}} </div>
								@enderror
								</p>
								<button type="submit" class="btn btn-info"> Apply </button>
							</form>
						</div>
						@endif
			     @endif
						<button class="btn btn-checkout" wire:click.prevent="checkout" wire:loading.remove>Check out</button>
						<button class="btn btn-checkout" wire:click.prevent="checkout" wire:loading>Proccessing...</button>
					</div>

					<div class="update-clear m-auto text-center">
						<div>	
							<a class="btn btn-clear" wire:click.prevent="destroyAll()">Clear Shopping Cart</a>
						</div>
							<div>
								<a class="btn btn-clear" href="/shop">Continue Shopping &nbsp;<i class="fa fa-arrow-circle-right" ></i></a>
							</div>
					</div>
				</div>
				@else
				    <div class="text-center">
						<h1> Your cart is empty ! </h1>
						<p> Add item to it now </p>
						<a href="/shop" class="btn btn-danger"> Shop Now </a>
					</div>
			@endif

				{{-- Save For Later --}}
				<div class="wrap-iten-in-cart" style="margin-top: 50px">

				@if (Cart::instance('saveForLater')->count() > 0)
					<h3 class="box-title">Save for Later </h3>
					<ul class="products-cart">

						@foreach (Cart::instance('saveForLater')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('storage/media/products/' .$item->model->image)}}" alt="{{ $item->model->slug }}">
								</figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{ route('product.details', $item->model->slug)}}"> {{ $item->model->name }} </a>
							</div>
							<div class="price-field produtc-price">
								@if ($item->model->sale_price>0 && $sale->status == 1 && $sale->sale_time > Carbon\Carbon::now())
								<p class="price"> $ {{ $item->model->sale_price }} </p>
								@else
								<p class="price"> $ {{ $item->model->regular_price }} </p>
								@endif
							</div>

							<div class="quantity">
								<p>
									<a href="javascript:void(0)" wire:click.prevent="moveToCart('{{$item->rowId}}')">
										Move to Cart
									</a>
								</p>
							</div>

							<div class="delete">
								<a class="btn btn-delete" title="Delete" wire:click.prevent="deleteFromSaveForLater('{{$item->rowId}}')">
									<span>Delete from your save for later</span>
									<i class="fa fa-times-circle"></i>
								</a>
							</div>
						</li>			
						@endforeach

					</ul>
				@endif
				</div>


			</div><!--end main content area-->
		</div><!--end container-->

	</main>
</div>
