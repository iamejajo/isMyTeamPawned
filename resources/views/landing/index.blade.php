<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAMPWNED - Check if your team is pwned</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Brand Color Variables - Using your brand color #1A5667 */
        :root {
            --brand-primary: #1A5667;      /* Main brand color - Your dark teal */
            --brand-secondary: #134A5A;    /* Darker shade for gradients */
            --brand-light: #2A7A8F;        /* Lighter shade for hover effects */
            --brand-lighter: #3B9BB3;      /* Even lighter for highlights */
            --brand-dark: #0F3D4A;         /* Darker shade for active states */
            --brand-rgb: 26, 86, 103;      /* RGB values for opacity effects */
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-circuit {
            background-image: url('/images/background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .glow {
            text-shadow: 0 0 10px rgba(var(--brand-rgb), 0.5);
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(var(--brand-rgb), 0.3);
        }

        .toggle-switch {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(var(--brand-rgb), 0.2);
            border-radius: 12px;
            padding: 4px;
            display: inline-flex;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .toggle-option {
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .toggle-option.active {
            background: linear-gradient(135deg, #0f766e, #115e59);
            color: white;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
        }

        .toggle-option:not(.active) {
            color: #9ca3af;
        }

        .toggle-option:not(.active):hover {
            color: white;
        }

        /* Enhanced pricing cards glow */
        .pricing-card {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .pricing-card:hover {
            border-color: var(--brand-primary);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(var(--brand-rgb), 0.1), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .pricing-card.featured {
            background: linear-gradient(145deg, rgba(var(--brand-rgb), 0.1), rgba(var(--brand-rgb), 0.05));
            border-color: var(--brand-primary);
            box-shadow: 0 8px 32px rgba(var(--brand-rgb), 0.1);
        }

        .pricing-card.featured:hover {
            box-shadow: 0 20px 40px rgba(var(--brand-rgb), 0.15), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .pricing-badge {
            color: var(--brand-primary);
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1rem;
            position: relative;
        }

        .pricing-badge::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--brand-primary), transparent);
        }

        .pricing-card.featured .pricing-badge::after {
            width: 60px;
            background: linear-gradient(90deg, var(--brand-primary), var(--brand-secondary));
        }

        .pricing-price {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-bar {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(var(--brand-rgb), 0.3);
            backdrop-filter: blur(10px);
        }

        .hero-bg {
            background: linear-gradient(180deg, #0a0a0a 0%, #0a0a0a 30%, transparent 50%, transparent 70%, #0a0a0a 100%);
        }

        .circuit-section {
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.3) 20%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.3) 80%, transparent 100%);
        }

        /* Spotlight effect for center content */
        .spotlight {
            background: radial-gradient(ellipse at center, rgba(var(--brand-rgb), 0.2) 0%, rgba(var(--brand-rgb), 0.1) 30%, rgba(var(--brand-rgb), 0.05) 50%, transparent 70%);
        }

        /* Dark corners effect */
        .dark-corners {
            background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.8) 100%);
        }

        /* Content illumination */
        .content-glow {
            /* Removed box-shadow to eliminate boxy appearance */
        }

        /* Pricing section spotlight */
        .pricing-spotlight {
            background: radial-gradient(ellipse at center, rgba(var(--brand-rgb), 0.15) 0%, rgba(var(--brand-rgb), 0.08) 40%, transparent 70%);
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Dark corners overlay -->
    <div class="fixed inset-0 dark-corners pointer-events-none z-0"></div>

    <!-- Navigation -->
    <nav class="relative z-10 bg-black bg-opacity-90 backdrop-blur-sm border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img src="/images/logo.svg" alt="TEAMPWNED" class="h-8">
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-teal-400 font-medium">Home</a>
                    <a href="{{ route('news') }}" class="text-white hover:text-teal-400 transition-colors">News</a>
                    <a href="{{ route('breach') }}" class="text-white hover:text-teal-400 transition-colors">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-white hover:text-teal-400 transition-colors">Pricing</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 rounded-md text-sm font-medium transition-all btn-glow">Register</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-white hover:text-teal-400 focus:outline-none focus:text-teal-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-black bg-opacity-95 border-t border-gray-800">
                    <a href="{{ route('home') }}" class="text-teal-400 block px-3 py-2 text-base font-medium">Home</a>
                    <a href="{{ route('news') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">News</a>
                    <a href="{{ route('breach') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Pricing</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 hover:bg-teal-800 text-white block px-3 py-2 text-base font-medium transition-all btn-glow">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with strategic background -->
    <div class="relative">
        <!-- Circuit board background - positioned strategically -->
        <div class="absolute inset-0 bg-circuit opacity-40" style="clip-path: polygon(0 25%, 100% 25%, 100% 100%, 0 100%);"></div>

        <!-- Solid background overlay with gradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black"></div>

        <!-- Spotlight effect for center content -->
        <div class="absolute inset-0 spotlight pointer-events-none"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
            <h1 class="text-6xl md:text-7xl lg:text-8xl font-black mb-4">
                <span class="text-teal-400">IS YOUR </span><span class="text-white">TEAM<span class="underline decoration-teal-400 decoration-4">PWNED</span></span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Check if one of your team's email address is in a data breach.
            </p>

            <!-- Email Check Form -->
            <div class="max-w-md mx-auto mb-8">
                <div class="flex gap-3">
                    <input type="email" placeholder="Email address" class="flex-1 px-4 py-3 bg-black bg-opacity-50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-teal-400 focus:ring-1 focus:ring-teal-400">
                    <button class="px-6 py-3 bg-teal-700 hover:bg-teal-800 text-white rounded-lg font-medium transition-all btn-glow">
                        Check
                    </button>
                </div>
                <p class="text-sm text-gray-400 mt-3">
                    Using IsMyTeamPwned is subject to the <a href="#" class="text-teal-400 hover:underline">terms of use</a>.
                </p>
            </div>

            <!-- Stats Bar -->
            <div class="stats-bar rounded-lg p-6 mb-16">
                <div class="flex items-center justify-between">
                    <div class="text-left">
                        <h3 class="text-xl font-bold text-white">PWNED Teams</h3>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-white">11,662,623,00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Value Proposition & Statistics Section -->
    <div class="bg-black relative">
        <!-- Section spotlight -->
        <div class="absolute inset-0 pricing-spotlight pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Value Proposition -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Why Choose <span class="text-teal-400">TEAMPWNED</span>?
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Protect your organization with enterprise-grade security monitoring that's simple to deploy and powerful enough for the world's largest companies.
                </p>
            </div>

            <!-- Value Features Grid -->
            <div class="grid md:grid-cols-3 gap-8 mb-20">
                <!-- Feature 1 -->
                <div class="text-center p-6 rounded-xl bg-gradient-to-br from-black/40 to-black/20 border border-teal-500/20 backdrop-blur-sm">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-teal-700 to-teal-800 rounded-full flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Real-Time Protection</h3>
                    <p class="text-gray-300 text-sm">
                        Monitor your entire team's email addresses 24/7 with instant breach detection and immediate alerts.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6 rounded-xl bg-gradient-to-br from-black/40 to-black/20 border border-teal-500/20 backdrop-blur-sm">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-teal-700 to-teal-800 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Advanced Analytics</h3>
                    <p class="text-gray-300 text-sm">
                        Get detailed insights into your security posture with comprehensive reporting and trend analysis.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6 rounded-xl bg-gradient-to-br from-black/40 to-black/20 border border-teal-500/20 backdrop-blur-sm">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-teal-700 to-teal-800 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Team Management</h3>
                    <p class="text-gray-300 text-sm">
                        Easily manage team members, set permissions, and coordinate security responses across your organization.
                    </p>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Trusted by <span class="text-teal-400">Thousands</span> of Companies
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-12">
                    Join the growing community of security-conscious organizations protecting their teams from data breaches.
                </p>
            </div>

            <!-- Statistics Grid -->
            <div class="grid md:grid-cols-4 gap-8 mb-16">
                <!-- Stat 1 -->
                <div class="text-center p-6">
                    <div class="text-4xl font-bold text-teal-400 mb-2">500+</div>
                    <div class="text-gray-300 text-sm font-medium">Companies Protected</div>
                </div>

                <!-- Stat 2 -->
                <div class="text-center p-6">
                    <div class="text-4xl font-bold text-teal-400 mb-2">50K+</div>
                    <div class="text-gray-300 text-sm font-medium">Email Addresses Monitored</div>
                </div>

                <!-- Stat 3 -->
                <div class="text-center p-6">
                    <div class="text-4xl font-bold text-teal-400 mb-2">99.9%</div>
                    <div class="text-gray-300 text-sm font-medium">Uptime Guarantee</div>
                </div>

                <!-- Stat 4 -->
                <div class="text-center p-6">
                    <div class="text-4xl font-bold text-teal-400 mb-2">&lt;30s</div>
                    <div class="text-gray-300 text-sm font-medium">Average Alert Time</div>
                </div>
            </div>

            <!-- Proof Points -->
            <div class="text-center">
                <div class="inline-flex items-center space-x-8 text-gray-400 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-teal-400 mr-2"></i>
                        SOC 2 Type II Compliant
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-teal-400 mr-2"></i>
                        GDPR Ready
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-teal-400 mr-2"></i>
                        ISO 27001 Certified
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom section with circuit background -->
    <div class="relative" style="margin-top: -4rem;">
        <!-- Circuit board background for bottom section -->
        <div class="absolute inset-0 bg-circuit opacity-50"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Footer -->
        <footer class="relative z-10 text-center py-8 text-gray-400 text-sm" style="padding-top: 5rem;">
            <p>privacy policy and @c2025 ismyteampwned.</p>
        </footer>
    </div>

    <script>
        function togglePricing(period) {
            const options = document.querySelectorAll('.toggle-option');
            options.forEach(option => option.classList.remove('active'));
            event.target.classList.add('active');

            // Update pricing based on period
            if (period === 'quarterly') {
                // Apply 10% discount
                const priceElements = document.querySelectorAll('.pricing-price');
                priceElements.forEach((price, index) => {
                    const currentText = price.textContent;
                    if (currentText.includes('$')) {
                        const amount = parseInt(currentText.replace('$', '').replace('/month', ''));
                        const discounted = Math.round(amount * 0.9);
                        price.innerHTML = `$${discounted}<span class="text-lg text-gray-400">/month</span>`;
                    }
                });
            } else {
                // Reset to original prices
                const priceElements = document.querySelectorAll('.pricing-price');
                const prices = ['$29', '$49', 'Let\'s Talk!'];
                priceElements.forEach((price, index) => {
                    if (index < 2) {
                        price.innerHTML = `${prices[index]}<span class="text-lg text-gray-400">/month</span>`;
                    } else {
                        price.textContent = prices[index];
                    }
                });
            }
        }

        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>

