@foreach ( $reviews as $review)
	
@endforeach
<div class="testimonial-block-two">
	<div class="inner-box">
		<div class="image">
			<img src="images/resource/author-4.jpg" alt="" />
		</div>
		<div class="text">{{$review->comment}}</div>
		<div class="lower-box">
			<div class="clearfix">

				<div class="pull-left">
					<div class="quote-icon flaticon-quote"></div>
				</div>
				<div class="pull-right">
					<div class="author-info">
						<h3>Max Winchester</h3>
						<div class="author">Kidny Patient</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>