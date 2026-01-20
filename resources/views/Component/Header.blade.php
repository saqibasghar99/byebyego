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
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <!-- Main Header -->
    <header class="main-header bg-white">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <!-- Logo -->
                <!-- <a class="navbar-brand" href="/">
                    <img src="https://via.placeholder.com/180x45?text=ShopEase" alt="ShopEase" class="logo-img">
                </a> -->

                <a class="navbar-brand" href="/" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.4rem; text-decoration: none;">
                    <span style="color: #1E73BE;">Bye</span>
                    <span style="color: #FF7A00;">Bye</span>
                    <span style="color: #333333;">Go</span>
                </a>

                <!-- Category Toggle Button -->
                <button class="category-toggle p-2 btn-sm" id="categoryToggle">
                    <i class="fas fa-bars"></i>
                    <span class="mb-sm-1">Categories</span>
                </button>

                <!-- Premium Search Bar -->
                <div class="search-container" style="position: relative;">
                    <form class="search-form" action="#">
                        <input type="text" id="searchInput" class="form-control shadow-none search-input" autocomplete="off" placeholder="Search products...">
                        <ul class="rounded-2" id="searchResults"></ul>
                        <button class="btn search-btn btn-sm" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Right Side Icons -->
                <div class="header-icons">
                    <!-- User Account Dropdown -->
                    <div class="dropdown user-dropdown">
                        <a class="dropdown-toggle header-icon " href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <span class="label">Account</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if(session()->has('id') || session()->has('google_user_id'))
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('purchase.history') }}"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            @else
                            <li><a class="dropdown-item" href="{{ route('signin') }}"><i class="fas fa-user me-2"></i>Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('purchase.history') }}"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            @endif
                        </ul>
                    </div>
                    
                    <!-- Cart -->
                    @if(session()->has('id') || session()->has('google_user_id'))
                    <a href="{{ route('cart.view') }}" class="header-icon" title="Cart">
                        <!-- <i class="fas fa-shopping-bag"></i> -->
                        <span class="material-symbols-outlined shopping-cart-icon fs-3">shopping_cart</span>
                        <small><span class="badge cart-count px-0" id="cart-count">{{ session('cart_quantity', 0) }}</span></small>
                    </a>
                    @else
                    <a href="{{ route('signin') }}" class="header-icon" title="Cart">
                         <span class="material-symbols-outlined shopping-cart-icon fs-3">shopping_cart</span>
                        <span class="badge cart-count px-0" id="cart-count">0</span>
                    </a>
                    @endif
                </div>
            </nav>
        </div>

        
        <div class="category-nav d-sm-block d-none" id="categories">
            <div class="container">
                <div class="nav">
                    @foreach($categories as $category)
                        <a class="nav-link text-white" href="{{ route('category.products', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </header>
    
    <!-- Category Sidebar -->
    <div class="category-sidebar" id="categorySidebar">
        <div class="sidebar-header">
            <h3>Shop Categories</h3>
            <button class="close-sidebar" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        
        <ul class="sidebar-categories">
            @foreach($categories as $category)
                <li><a href="{{ route('category.products', $category->slug) }}"><i class="fas fa-gem"></i> {{ $category->name }}</a></li>
            @endforeach
        </ul>
        
        <div class="sidebar-footer">
            <a href="#categories">
                View All Categories
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const resultsList = document.getElementById('searchResults');

            // Style the results container (modern look)
            resultsList.style.position = 'absolute';
            resultsList.style.top = '100%';
            resultsList.style.left = '0';
            resultsList.style.right = '0';
            resultsList.style.background = '#ffffff';
            resultsList.style.border = '1px solid #ddd';
            resultsList.style.borderRadius = '8px';
            resultsList.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            resultsList.style.padding = '5px 0';
            resultsList.style.zIndex = '1050';
            resultsList.style.maxHeight = '300px';
            resultsList.style.overflowY = 'auto';
            resultsList.style.display = 'none';

            searchInput.addEventListener('input', function () {
                let query = this.value;

                if (query.length > 1) {
                    fetch(`/live-search?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            resultsList.innerHTML = '';
                            resultsList.style.display = 'block';

                            if (data.length > 0) {
                                data.forEach(product => {
                                    resultsList.innerHTML += `
                                        <li style="list-style: none;">
                                            <a href="/product/${product.id}" 
                                            style="display: flex; align-items: center; padding: 5px 8px; text-decoration: none; color: #333; transition: background 0.2s; border-bottom: 1px solid #f0f0f0;">
                                                <img src="/storage/${product.image}" 
                                                    alt="${product.productname}" 
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; margin-right: 12px; flex-shrink: 0;">
                                                <div style="display: flex; flex-direction: column;">
                                                    <span style="font-weight: 500; font-size: 0.95rem;">${product.productname}</span>
                                                    <span style="font-size: 0.85rem; color: #666;">${product.tags}</span>
                                                </div>
                                                <span style="margin-left:auto; font-weight: 600; color: #FF7A00;">Rs. ${product.totalprice}</span>
                                            </a>
                                        </li>
                                    `;
                                });
                            } else {
                                resultsList.innerHTML = `
                                    <li style="list-style: none; padding: 10px; text-align: center; color: #999;">
                                        No products found
                                    </li>
                                `;
                            }

                            // Hover effect for each link
                            resultsList.querySelectorAll('a').forEach(item => {
                                item.addEventListener('mouseover', () => {
                                    item.style.background = '#f5f5f5';
                                });
                                item.addEventListener('mouseout', () => {
                                    item.style.background = '#ffffff';
                                });
                            });
                        });
                } else {
                    resultsList.innerHTML = '';
                    resultsList.style.display = 'none';
                }
            });

            // Hide results when clicking outside
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
                    resultsList.style.display = 'none';
                }
            });
        });


        // Category Sidebar Toggle
        const categoryToggle = document.getElementById('categoryToggle');
        const categorySidebar = document.getElementById('categorySidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        categoryToggle.addEventListener('click', () => {
            categorySidebar.classList.add('active');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeSidebar.addEventListener('click', () => {
            categorySidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        sidebarOverlay.addEventListener('click', () => {
            categorySidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Add animation to dropdown items
        document.querySelectorAll('.dropdown-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.05}s`;
        });
        
        // Search input focus effect
        const searchInput = document.querySelector('.search-input');
        const searchSuggestions = document.querySelector('.search-suggestions');
        
        searchInput.addEventListener('focus', () => {
            searchSuggestions.style.display = 'block';
        });
        
        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                searchSuggestions.style.display = 'none';
            }, 200);
        });
    </script>
</body>
</html>