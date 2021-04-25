<div>
	<main id="main" class="main-site left-sidebar">
		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Shop</span></li>
				</ul>
			</div>

            <div class="row">
                <ul class="product-list grid-products equal-container my-5">

                 @if ( Cart::instance('wishlist')->content()->count() > 0 )
                    @foreach ( Cart::instance('wishlist')->content() as $item)
                    <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                        <div class="product product-style-3 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product.details', $item->model->slug) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure>
                                        <img src="{{asset('storage/media/products/' .$item->model->image)}}" alt="{{$item->model->slug}}">
                                    </figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a class="product-name">
                                    <span> {{$item->model->name}} </span>
                                </a>
                                <div class="wrap-price">
                                    <span class="product-price">${{$item->model->regular_price}}</span>
                                </div>
                                <a class="btn add-to-cart" wire:click.prevent="moveProductWishlistToCart('{{$item->rowId}}')">Move To Cart</a>

                                <div class="product-wishlist">
                                    <a href="javascript:void(0)" wire:click.prevent="removeFromWishlist({{$item->model->id}})" class="fill-heart" title="Remove From Wishlist"> 
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else 
                    <h2 class="text-center my-5 text-danger"> No Wishlist Item Found </h2>
                @endif

                </ul>
            </div> 

        </div>
    </main>
</div>