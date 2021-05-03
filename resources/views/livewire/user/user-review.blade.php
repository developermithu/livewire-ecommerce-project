<div>
    <div class="container">
        
        {{-- @if (Session::has('success'))
            <div class="row" style="margin: 20px 0">
                    <div class="col-md-12">
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                </div>
            </div>
        @endif --}}
            
        <div class="row" style="margin: 15px 0">
            <div class="col-md-12">
                <div class="wrap-review-form">									
                    <div id="comments">
                        <h2 class="woocommerce-Reviews-title">Add Review for <span>{{$orderItem->product->name}}</span></h2>
                        <ol class="commentlist">
                            <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                <div id="comment-20" class="comment_container"> 
                                    <img src="{{asset('storage/media/products/' .$orderItem->product->image)}}" height="80" width="80" alt="{{$orderItem->product->slug}}" >
                                </div>
                            </li>
                        </ol>
                    </div><!-- #comments -->
            
                    <div id="review_form_wrapper">
                        <div id="review_form">
                            <div id="respond" class="comment-respond"> 
            
                                <form wire:submit.prevent="addReview" id="commentform" class="comment-form" novalidate="">
                                    <div class="comment-form-rating">
                                        <span>Your rating : {{$rating}}</span>
                                        <p class="stars">
                                            <label for="rated-1"></label>
                                            <input type="radio" id="rated-1" value="1" wire:model="rating" >
                                            <label for="rated-2"></label>
                                            <input type="radio" id="rated-2" value="2" wire:model="rating" >
                                            <label for="rated-3"></label>
                                            <input type="radio" id="rated-3" value="3" wire:model="rating" >
                                            <label for="rated-4"></label>
                                            <input type="radio" id="rated-4" value="4" wire:model="rating" >
                                            <label for="rated-5"></label>
                                            <input type="radio" id="rated-5" value="5" checked="checked" wire:model="rating" >
                                            @error('rating') <span class="text-danger" style="margin-left: 30px">{{$message}}</span> @enderror
                                        </p>
                                    </div>
                                    <p class="comment-form-comment">
                                        <textarea id="comment" name="comment" cols="20" rows="8" wire:model="comment"></textarea>
                                        @error('comment') <div class="text-danger">{{$message}}</div> @enderror
                                    </p>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                    </p>
                                </form>
            
                            </div><!-- .comment-respond-->
                        </div><!-- #review_form -->
                    </div><!-- #review_form_wrapper -->
            
                </div>
            </div>
        </div>
    </div>
</div>
