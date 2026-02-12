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
    <style>
        :root {
            --primary-color: #000000;
            --accent-color: #db5c07;
            --price-color: #2ecc71;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
        }

        /* New Banner Design */
        .modern-banner {
            /* background: linear-gradient(135deg, #3d3c3c 0%, #302e2e 100%); */
            background-color: white;
            min-height: 500px;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: linear-gradient(90deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.3) 100%); */
            background-color: white;

            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .badge-premium {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 05rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .main-headline {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 15px;
            color: white;
            background-clip: text;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .main-headline span {
            color: white;
        }

        .tagline {
            font-size: 1.8rem;
            font-weight: 300;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .price-section {
            margin: 10px 0;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            max-width: 400px;
        }

        .price-label {
            font-size: 0.9rem;
            color: #aaa;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2ecc71;
        }

        .price-period {
            font-size: 1rem;
            color: #aaa;
        }

        .product-highlight {
            background: rgba(255, 255, 255, 0.05);
            border-left: 4px solid var(--accent-color);
            padding: 15px;
            margin-top: 20px;
            max-width: 400px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 1rem;
            color: #2ecc71;
            font-weight: 700;
        }

        .partner-text {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #aaa;
            max-width: 400px;
        }

        .cta-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn-investigate {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-investigate:hover {
            transform: translateY(-2px);
        }

        .btn-shop {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 10px 28px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background: white;
            color: black;
            transform: translateY(-2px);
        }

        .banner-image-container {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-showcase {
            position: relative;
            z-index: 2;
            animation: float 3s ease-in-out infinite;
        }

        .product-showcase img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }


        /* Responsive Design */
        @media (max-width: 992px) {
            .modern-banner {
                min-height: 400px;
                padding: 30px 0;
            }

            .main-headline {
                font-size: 2.8rem;
            }

            .tagline {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .modern-banner {
                min-height: 350px;
                padding: 20px 0;
            }

            .main-headline {
                font-size: 2rem;
            }

            .tagline {
                font-size: 1.2rem;
            }

            .banner-image-container {
                margin-top: 30px;
            }

            .product-showcase img {
                max-height: 300px;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .btn-investigate, .btn-shop {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .modern-banner {
                min-height: 300px;
            }

            .main-headline {
                margin-top: 20px;
                font-size: 1.6rem;
            }

            .tagline {
                font-size: 1rem;
            }

            .price-value {
                font-size: 2rem;
            }
        }

        .product-showcase img {
            max-width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            clip-path: ellipse(70% 50% at 50% 50%);
            transition: transform 0.3s ease;
        }

        .product-showcase img:hover {
            transform: scale(1.05) rotate(1deg);
        }

        
    </style>
</head>
<body>
    <!-- New Modern Banner -->
    <div class="modern-banner"
        style="background-image: url('{{ $setting && $setting->landing_banner_image
            ? Storage::url($setting->landing_banner_image)
            : 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}');">
        
        <div class="banner-overlay"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        
                        @if($setting->show_hero_text)
                        <h1 class="main-headline" style="color: {{ $setting->hero_title_color ?? '#ffffff' }};">
                            {!! $setting->hero_title ?? 'Shop Smart, Save Time' !!}<br>
                            <span style="color: {{ $setting->hero_subtitle_color ?? '#ffffff' }};">
                                {!! $setting->hero_subtitle ?? 'BUY & REPEAT' !!}
                            </span>
                        </h1>
                        @endif
                        
                        <div class="price-section">
                            @if($mostValuedProduct)
                                <div class="product-highlight">
                                    <div class="d-flex flex-row">
                                        <div class="product-name" style="color: black">
                                            {{ $mostValuedProduct->productname }}.. 
                                        </div>
                                        <div class="product-name d-none mx-1 mx-md-2 border-bottom border-2 px-md-2 shadow-lg text-black">
                                            PKR {{ $mostValuedProduct->totalprice }}.
                                        </div>
                                    </div>
                                    <div class="product-price" style="color: #db5c07">
                                        Most trending product people like more
                                    </div>
                                </div>

                            @else
                                <div class="price-label">Fast Delivery</div>
                                <div class="price-value">Get your orders delivered quickly with our express shipping options.</span></div>
                            @endif
                        </div>

                        @if($setting->hero_subtitle_line)
                        <p class="partner-text" style="color: {{ $setting->hero_subtitle_line_color ?? '#ffffff' }};">
                            {!! $setting->hero_subtitle_line ?? 'Invest in quality, enjoy every purchase, experience shopping reimagined.' !!}
                        </p>
                        @endif
                        
                        <div class="cta-buttons">
                            @if($setting->show_hero_button)
                            <button class="btn-investigate">
                                <i class="fas fa-search me-2"></i> {{ $setting->hero_button_text ?? 'Shop Now' }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="banner-image-container d-none d-md-block">
                        <div class="product-showcase">
                            @if($mostValuedProduct && $mostValuedProduct->image)
                                <img src="{{ Storage::url($mostValuedProduct->image) }}" 
                                    alt="{{ $mostValuedProduct->productname }}" 
                                    class="img-fluid">
                            @else
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                    alt="Premium Product"
                                    class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Categories Section (Unchanged) -->
    <div class="container">
        <h4 class="section-title text-center my-5">Shop by Category</h4>

        <div class="categories-carousel">
            @foreach($categories as $category)
                @if($category->name !== 'Featured')
                    <div class="category-item mx-md-0 mx-4">
                        <a href="{{ route('category.products', $category->slug) }}" class="category-card">
                            <div class="category-img">
                                <img loading="lazy"
                                    src="{{ asset($category->image ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') }}"
                                    alt="{{ $category->name }}"
                                    class="img-fluid">
                            </div>
                            <div class="category-overlay">
                                <span>Shop Now <i class="fas fa-arrow-right ms-2"></i></span>
                            </div>
                        </a>
                        <p class="category-name fw-bold mt-2 text-center">
                            {{ $category->name }}
                        </p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Button hover effects
            const buttons = document.querySelectorAll('.btn-investigate, .btn-shop');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add click functionality to buttons
            document.querySelector('.btn-investigate').addEventListener('click', function() {
                window.location.href = '#featured-products';
            });

            document.querySelector('.btn-shop').addEventListener('click', function() {
                window.location.href = '{{ $setting->hero_button_link ?? "#" }}';
            });

            // Parallax effect for banner
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const banner = document.querySelector('.modern-banner');
                const rate = scrolled * 0.1;
                banner.style.transform = `translateY(${rate}px)`;
            });
        });
    </script>
</body>
</html>