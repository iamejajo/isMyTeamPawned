<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAMPWNED - Check if your team is pwned</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
        }

        .toggle-switch {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 212, 255, 0.2);
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
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
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
            border: 1px solid rgba(0, 212, 255, 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .pricing-card:hover {
            border-color: #00d4ff;
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 212, 255, 0.1), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .pricing-card.featured {
            background: linear-gradient(145deg, rgba(0, 212, 255, 0.1), rgba(0, 212, 255, 0.05));
            border-color: #00d4ff;
            box-shadow: 0 8px 32px rgba(0, 212, 255, 0.1);
        }

        .pricing-card.featured:hover {
            box-shadow: 0 20px 40px rgba(0, 212, 255, 0.15), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .pricing-badge {
            color: #00d4ff;
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
            background: linear-gradient(90deg, #00d4ff, transparent);
        }

        .pricing-card.featured .pricing-badge::after {
            width: 60px;
            background: linear-gradient(90deg, #00d4ff, #0099cc);
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
            border: 1px solid rgba(0, 212, 255, 0.3);
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
            background: radial-gradient(ellipse at center, rgba(0, 212, 255, 0.2) 0%, rgba(0, 212, 255, 0.1) 30%, rgba(0, 212, 255, 0.05) 50%, transparent 70%);
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
            background: radial-gradient(ellipse at center, rgba(0, 212, 255, 0.15) 0%, rgba(0, 212, 255, 0.08) 40%, transparent 70%);
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
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">News</a>
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">Breach</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-cyan-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-all btn-glow">Register</a>
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
                <span class="text-cyan-400">IS YOUR </span><span class="text-white">TEAM<span class="underline decoration-cyan-400 decoration-4">PWNED</span></span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Check if your email address is in a data breach.
            </p>

            <!-- Email Check Form -->
            <div class="max-w-md mx-auto mb-8">
                <div class="flex gap-3">
                    <input type="email" placeholder="Email address" class="flex-1 px-4 py-3 bg-black bg-opacity-50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400">
                    <button class="px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg font-medium transition-all btn-glow">
                        Check
                    </button>
                </div>
                <p class="text-sm text-gray-400 mt-3">
                    Using Have I Been Pwned is subject to the <a href="#" class="text-cyan-400 hover:underline">terms of use</a>.
                </p>
            </div>

            <!-- Stats Bar -->
            <div class="stats-bar rounded-lg p-6 mb-16">
                <div class="flex items-center justify-between">
                    <div class="text-left">
                        <h3 class="text-xl font-bold text-white">PWNED Team</h3>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-white">11,662,623,00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section with solid background -->
    <div class="bg-black relative">
        <!-- Pricing section spotlight -->
        <div class="absolute inset-0 pricing-spotlight pointer-events-none"></div>

        <!-- Pricing Toggle -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 text-center">
            <div class="toggle-switch">
                <div class="toggle-option active" onclick="togglePricing('monthly')">Monthly</div>
                <div class="toggle-option" onclick="togglePricing('quarterly')">Quarterly (save 10%)</div>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <!-- PRO Card -->
            <div class="pricing-card rounded-xl p-8">
                <div class="pricing-badge">PRO</div>
                <div class="pricing-price mb-4">$29<span class="text-lg text-gray-400">/month</span></div>
                <hr class="border-gray-600 mb-6">
                <ul class="text-gray-300 space-y-3 text-sm mb-8">
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Email monitoring</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Basic alerts</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Team dashboard</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>24/7 support</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Get Started
                </button>
            </div>

            <!-- PRO PLUS Card -->
            <div class="pricing-card rounded-xl p-8">
                <div class="pricing-badge">PRO PLUS</div>
                <div class="pricing-price mb-4">$49<span class="text-lg text-gray-400">/month</span></div>
                <hr class="border-gray-600 mb-6">
                <ul class="text-gray-300 space-y-3 text-sm mb-8">
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Everything in PRO</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Domain monitoring</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Advanced analytics</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Priority support</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Custom integrations</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Get Started
                </button>
            </div>

            <!-- Custom Card -->
            <div class="pricing-card rounded-xl p-8">
                <div class="pricing-badge">Custom</div>
                <div class="pricing-price mb-4">Let's Talk!</div>
                <hr class="border-gray-600 mb-6">
                <ul class="text-gray-300 space-y-3 text-sm mb-8">
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Enterprise features</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Custom integrations</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>Dedicated support</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>SLA guarantees</li>
                    <li class="flex items-center"><span class="text-cyan-400 mr-2">✓</span>White-label options</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Contact Us
                </button>
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
    </script>
</body>
</html>

