
<section class="spd-reviews" id="productReviews">
    <div class="spd-container">

        <div class="spd-section-heading">
            <span>CUSTOMER EXPERIENCES</span>
            <h2>Customer Reviews</h2>
            <p>See what customers say about this product.</p>
        </div>

        <div class="spd-reviews-layout">

            {{-- REVIEWS LIST --}}
            <div class="spd-reviews-list">

                <div class="spd-reviews-summary">
                    <strong>{{ $product->rating_value }}</strong>

                    <span class="spd-review-star" aria-hidden="true">
                        ★
                    </span>

                    <span>
                        {{ $product->rating_count }}
                        {{ $product->rating_count === 1 ? 'review' : 'reviews' }}
                    </span>
                </div>

                @forelse($reviews as $review)
                    <article class="spd-review-card">

                        <div class="spd-review-header">
                            <strong>{{ $review->name }}</strong>

                            <span aria-label="{{ $review->rating }} out of 5 stars">
                                <span aria-hidden="true">
                                    {{ str_repeat('★', (int) $review->rating) }}
                                    {{ str_repeat('☆', 5 - (int) $review->rating) }}
                                </span>
                            </span>
                        </div>

                        <p>{{ $review->review }}</p>

                        <small>
                            {{ $review->created_at->format('d M Y') }}
                        </small>

                    </article>
                @empty
                    <div class="spd-reviews-empty">
                        <p>
                            No reviews yet. Be the first to review this product.
                        </p>
                    </div>
                @endforelse

                @if($reviews->hasPages())
                    <div class="spd-review-pagination">
                        {{ $reviews->fragment('productReviews')->links() }}
                    </div>
                @endif

            </div>

            {{-- REVIEW SUBMISSION FORM --}}
            <div class="spd-review-form-card">

                <h3>Write a Review</h3>
                <p>Share your experience with this product.</p>

                {{-- SUCCESS MESSAGE --}}
                @if(session('review_success'))
                    <div class="spd-review-success" role="status">
                        {{ session('review_success') }}
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if($errors->any())
                    <div class="spd-review-error" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('products.reviews.store', $product->slug) }}"
                >
                    @csrf

                    {{-- CUSTOMER NAME --}}
                    <div class="spd-review-field">
                        <label for="reviewName">
                            Your Name *
                        </label>

                        <input
                            type="text"
                            id="reviewName"
                            name="name"
                            value="{{ old('name') }}"
                            maxlength="150"
                            autocomplete="name"
                            required
                        >
                    </div>

                    {{-- EMAIL ADDRESS --}}
                    <div class="spd-review-field">
                        <label for="reviewEmail">
                            Email Address *
                        </label>

                        <input
                            type="email"
                            id="reviewEmail"
                            name="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            autocomplete="email"
                            required
                        >

                        <small>
                            Your email will not be displayed publicly.
                        </small>
                    </div>

                    {{-- RATING --}}
                    <div class="spd-review-field">
                        <label for="reviewRating">
                            Your Rating *
                        </label>

                        <select
                            id="reviewRating"
                            name="rating"
                            required
                        >
                            <option value="">
                                Select Rating
                            </option>

                            @foreach([5, 4, 3, 2, 1] as $star)
                                <option
                                    value="{{ $star }}"
                                    @selected((string) old('rating') === (string) $star)
                                >
                                    {{ $star }}
                                    {{ $star === 1 ? 'Star' : 'Stars' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- REVIEW TEXT --}}
                    <div class="spd-review-field">
                        <label for="reviewComment">
                            Your Review *
                        </label>

                        <textarea
                            id="reviewComment"
                            name="review"
                            rows="5"
                            minlength="10"
                            maxlength="2000"
                            placeholder="Tell us about your experience..."
                            required
                        >{{ old('review') }}</textarea>
                    </div>

                    {{-- SPAM HONEYPOT --}}
                    <div
                        aria-hidden="true"
                        style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;"
                    >
                        <label for="reviewWebsite">
                            Leave this field empty
                        </label>

                        <input
                            type="text"
                            id="reviewWebsite"
                            name="website"
                            value=""
                            tabindex="-1"
                            autocomplete="off"
                        >
                    </div>

                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="spd-review-submit"
                    >
                        Submit Review →
                    </button>

                    <small class="spd-review-notice">
                        Reviews are published after admin approval.
                    </small>

                </form>

            </div>

        </div>

    </div>
</section>
