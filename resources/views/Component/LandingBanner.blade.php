<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase - Premium Ecommerce</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Banner.css') }}">
</head>
<body>
    <!-- Hero Banner -->
    <div class="luxury-container"
     style="
        background-image: url('{{ $setting && $setting->landing_banner_image
            ? Storage::url($setting->landing_banner_image)
            : asset('images/default-banner.jpg') }}');
        background-size: cover;
        background-position: center;

        --title-color: {{ session('hero_title_color', '#ffffff') }};
        --subtitle-color: {{ session('hero_subtitle_color', '#f1f1f1') }};
        --btn-text-color: {{ session('hero_button_text_color', '#ffffff') }};
        --btn-bg-color: {{ session('hero_button_bg_color', '#000000') }};
     ">

        <div class="decorative-line"></div>

        @if($setting && $setting->show_hero_text)
            <div class="collection-header">
                {{ $setting->hero_title ?? 'SUMMER COLLECTION' }}
            </div>

            <h2 class="collection-title w-75">
                {{ $setting->hero_subtitle ?? 'Shop the trends you love in ' }}
                <span id="current-year"></span>
            </h2>

            <p class="collection-subtitle text-dark">
                Enjoy unbeatable prices on handpicked collections, featuring the latest trends,
                all delivered right to your doorstep with ease
            </p>
        @endif

        @if($setting && $setting->show_hero_button)
            <a href="{{ $setting->hero_button_link ?? '#featured-products' }}"
            class="shop-now-btn" target="_blank">
                {{ $setting->hero_button_text ?? 'SHOP NOW' }}
            </a>
        @endif

    </div>



    <section class="categories-section py-5">
        <div class="container">
            <h4 class="section-title text-center mb-5">Shop by Category</h4>
            <div class="row g-4" id="categories">
                @foreach($categories as $category)
                <div class="col-md-4 col-6">
                    <a href="{{ route('category.products', $category->slug) }}" class="category-card">
                        <div class="category-img">
                            <img loading="lazy" src="{{ asset($category->image ?? 'images/default-category.jpg') }}" 
                                alt="{{ $category->name }}" class="img-fluid">
                        </div>
                        <div class="category-overlay">
                            <h3>{{ $category->name }}</h3>
                            <span>Shop Now <i class="fas fa-arrow-right ms-2"></i></span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <script>
        document.getElementById("current-year").textContent = new Date().getFullYear();
    </script>

</script>
</body>
</html>