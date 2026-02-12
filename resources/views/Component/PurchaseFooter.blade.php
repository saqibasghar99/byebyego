

<footer class="text-light pt-5 pb-3" style="background-color: #333333;">
    <div class="container">
        <div class="row">

            <!-- Brand Info -->
            <div class="col-md-3 mb-4">
                <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                    <img src="{{ asset('img/3bg.png') }}" alt="ShopEase" class="logo-img shadow-none">
                </h4>
                <p class=" small">
                    Welcome to our store, where quality meets affordability. We offer fast shipping, secure payments, and a seamless shopping experience. Shop with confidence and find everything you need in one place
                </p>
            </div>

            <!-- Office Info -->
            <div class="col-md-3 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Office</h6>
                <p class=" small mb-1">Multan Road<br>Thokar Niaz Baig<br>Lahore, Punjab<br>Pakistan</p>
                <p class=" small mb-1">
                    <a href="mailto:avinashdm@outlook.com" class="text-decoration-none text-light">avinashdm@outlook.com</a>
                </p>
                <p class="small mb-0 fw-bold">
                    <a href="https://wa.me/923471428593" target="_blank" class="text-decoration text-white">
                        +92 347 1428593
                    </a>
                </p>
            </div>

            <!-- Links -->
            <div class="col-md-2 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Shop</h6>
                @php
                    // Filter out "Featured" and shuffle
                    $filteredCategories = $categories->filter(function($c){
                        return strtolower(trim($c->name)) !== 'featured';
                    })->shuffle()->take(6); // take only 5 randomly
                @endphp

                <ul class="list-unstyled small">
                    @foreach($filteredCategories as $category)
                        <li>
                            <a href="{{ route('category.products', $category->slug) }}" class="text-decoration-none text-light">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>

            <!-- Newsletter -->
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Newsletter</h6>
                <form class="d-flex mb-3">
                    <input type="email" class="shadow-none form-control white-placeholder me-2 bg-transparent text-white border-bottom border-secondary" placeholder="Enter your email id" style="border-radius: 0; border-top: none; border-left: none; border-right: none;">
                    <button type="submit" class="btn btn-outline-light border-0"><i class="fas fa-arrow-right"></i></button>
                </form>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/923471428593" target="_blank" class="text-light"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

        </div>

        <!-- Bottom -->
        <div class="text-center border-top border-secondary pt-3 mt-4">
            <p class="mb-0  small">PriceOye © 2025 – All Rights Reserved</p>
        </div>
    </div>
</footer>

