

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Premium Profile | LuxeCart</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Profile.css') }}">
</head>
<body>

<div>
    @include('component.header')
</div>

    <div class="ecommerce-profile">
        <!-- Premium Profile Header -->
        <div class="profile-hero">
            <div class="hero-overlay"></div>
            <div class="profile-identity">
                <div class="avatar-container">
                    <div class="premium-avatar">{{ substr($user->name, 0, 1) }}</div>
                    <div class="verified-badge">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <div class="user-info">
                    <h1 class="user-name">{{ $user->name }}</h1>
                    <p class="user-title">Premium Member Since {{ $member_since }}</p>
                    <div class="user-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{ $stats['order_count'] }}</span>
                            <span class="stat-label">Orders</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">PKR {{ number_format($stats['total_spent'], 2) }}</span>
                            <span class="stat-label">Total Spent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-main">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                <li class="nav-item fw-bold" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Profile</button>
                </li>
                <li class="nav-item fw-bold" role="presentation">
                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">Settings</button>
                </li>
                <li class="nav-item fw-bold" role="presentation">
                    <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">Security</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="personal-info-grid">
                        <div class="info-group">
                            <span class="info-label">Full Name</span>
                            <p class="info-value">{{ $user->name }}</p>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Email</span>
                            <p class="info-value">{{ $user->email }}</p>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Member Since</span>
                            <p class="info-value">{{ $member_since }}</p>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings" role="tabpanel">
                    <form method="POST" action="{{ route('profile.update') }}" class="settings-form">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn save-btn">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    <form method="POST" action="{{ route('profile.password') }}" class="settings-form">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn save-btn">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<div>
    @include('component.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        function resetForm() {
            document.querySelector('form[action="{{ route('profile.update') }}"]').reset();
        }

        function resetPasswordForm() {
            document.querySelector('form[action="{{ route('profile.password') }}"]').reset();
        }

        // Close alert
        document.querySelector('.close-alert')?.addEventListener('click', function() {
            this.parentElement.style.opacity = '0';
            setTimeout(() => {
                this.parentElement.remove();
            }, 300);
        });

        // Add animation to avatar on load
        const avatar = document.querySelector('.premium-avatar');
        setTimeout(() => {
            avatar.style.transform = 'scale(1.05)';
            setTimeout(() => {
                avatar.style.transform = 'scale(1)';
            }, 300);
        }, 500);
    </script>
</body>
</html>