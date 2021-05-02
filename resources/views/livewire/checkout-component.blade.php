<div>
	<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>checkout</span></li>
				</ul>
			</div>

			<div class=" main-content-area">
				<form wire:submit.prevent="placeOrder">
					<div class="row">
						<div class="col-md-12">
							<div class="wrap-address-billing">
								<h3 class="box-title">Billing Address</h3>
								<div class="billing-address">
									<p class="row-in-form">
										<label>Name<span>*</span></label>
										<input type="text" wire:model="name">
										@error('name')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Email<span>*</span></label>
										<input type="text" wire:model="email" >
										@error('email')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Mobile<span>*</span></label>
										<input type="number" wire:model="mobile">
										@error('mobile')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Line 1<span>*</span></label>
										<input type="text" wire:model="line1" >
										@error('line1')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Line 2</label>
										<input type="text" wire:model="lin2">
										@error('lin2')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Postcode / ZIP <span>*</span></label>
										<input  type="number" wire:model="zipcode" >
										@error('zipcode')
										<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Country<span>*</span></label>
										<input type="text" wire:model="country">
										@error('country')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>Province<span>*</span></label>
										<input type="text" wire:model="province">
										@error('province')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label>City<span>*</span></label>
										<input type="text" wire:model="city" >
										@error('city')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</p>
									<p class="row-in-form fill-wife text-danger">
										<label class="checkbox-field">
											<input wire:model="ship_to_different" name="different-add" value="1" type="checkbox">
											<span>Ship to a different address?</span>
										</label>
									</p>
								</div>
							</div>
						</div>

						@if ($ship_to_different)
							<div class="col-md-12">
								<div class="wrap-address-billing">
									<h3 class="box-title">Shipping Address</h3>
										<div class="shipping-address">
											<p class="row-in-form">
												<label>Name<span>*</span></label>
												<input type="text" wire:model="ship_name" >
												@error('ship_name')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Email<span>*</span></label>
												<input type="text" wire:model="ship_email" >
												@error('ship_email')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Mobile<span>*</span></label>
												<input type="number" wire:model="ship_mobile" >
												@error('ship_mobile')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Line 1<span>*</span></label>
												<input type="text" wire:model="ship_line1" >
												@error('ship_line1')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Line 2</label>
												<input type="text" wire:model="ship_lin2" >
												@error('ship_lin2')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Postcode / ZIP <span>*</span></label>
												<input  type="number" wire:model="ship_zipcode" >
												@error('ship_zipcode')
												<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Country<span>*</span></label>
												<input type="text" wire:model="ship_country" >
												@error('ship_country')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>Province<span>*</span></label>
												<input type="text" wire:model="ship_province" >
												@error('ship_province')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
											<p class="row-in-form">
												<label>City<span>*</span></label>
												<input type="text" wire:model="ship_city" >
												@error('ship_city')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</p>
										</div>
									</div>
								</div>
							@endif
					</div>				

					<div class="summary summary-checkout">
						<div class="summary-item payment-method">
							<h4 class="title-box">Payment Method</h4>
							@if ($payment_method == 'card')
							<div class="wrap-address-billing">
								@if (Session::has('stripe_error'))
									<div class="alert alert-danger">{{Session::get('stripe_error')}}</div>
								@endif
								<p>
									<h5>For free check type:</h5>
										<b>Card Number: 4242424242424242, </b> <br>
										<b>Expiry Month: 12, </b> <br>
										<b>Expiry Year: 2025,</b> <br>
										<b> CVC: 234</b> <br>
								</p>
								<p class="row-in-form">
									<label>Card Number<span>*</span></label>
									<input type="text" wire:model="card_number">
									@error('card_number')
										<span class="text-danger">{{$message}}</span>
									@enderror
								</p>
								<p class="row-in-form">
									<label>Expiry Month<span>*</span></label>
									<input type="text" wire:model="expiry_month">
									@error('expiry_month')
										<span class="text-danger">{{$message}}</span>
									@enderror
								</p>
								<p class="row-in-form">
									<label>Expiry Year<span>*</span></label>
									<input type="text" wire:model="expiry_year">
									@error('expiry_year')
										<span class="text-danger">{{$message}}</span>
									@enderror
								</p>
								<p class="row-in-form">
									<label>CVC<span>*</span></label>
									<input type="password" wire:model="cvc">
									@error('cvc')
										<span class="text-danger">{{$message}}</span>
									@enderror
								</p>
							</div>
							@endif
								
							<div class="choose-payment-methods">
								<label class="payment-method">
									<input wire:model="payment_method" value="cod" type="radio">
									<span>Cash On Delivery</span>
									<span class="payment-desc">Cash On Delivery</span>
								</label>
								<label class="payment-method">
									<input wire:model="payment_method" value="card" type="radio">
									<span>Debit / Credit Card</span>
									<span class="payment-desc">Now you can pay your bill using stripe card</span>
								</label>
								<label class="payment-method">
									<input wire:model="payment_method" value="paypal" type="radio">
									<span>Paypal</span>
									<span class="payment-desc">You can pay with your credit</span>
									<span class="payment-desc">card if you don't have a paypal account</span>
								</label>
								@error('payment_method')
									<div class="text-danger">{{$message}}</div>
								@enderror
							</div>

							@if (Session::has('checkout'))
							<p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">${{Session::get('checkout')['total']}}</span></p>
							@endif

							<button type="submit" class="btn btn-medium">Place order now</button>
						</div>
						<div class="summary-item shipping-method">
							<h4 class="title-box f-title">Shipping method</h4>
							<p class="summary-info"><span class="title">Flat Rate</span></p>
							<p class="summary-info"><span class="title">Fixed $0</span></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
</div>
