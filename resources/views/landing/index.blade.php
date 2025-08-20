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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 4px;
            display: inline-flex;
            position: relative;
        }

        .toggle-option {
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .toggle-option.active {
            background: #00d4ff;
            color: white;
        }

        .toggle-option:not(.active) {
            color: white;
        }

        .pricing-card {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 212, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.08);
        }

        .pricing-card:hover {
            border-color: #00d4ff;
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.15), 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .pricing-card.featured {
            background: rgba(0, 212, 255, 0.1);
            border-color: #00d4ff;
            box-shadow: 0 0 25px rgba(0, 212, 255, 0.12);
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
                    <a href="{{ route('register') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-all btn-glow">Register</a>
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
                <span class="text-cyan-400">IS YOUR</span><br>
                <span class="text-white">TEAM<span class="underline decoration-cyan-400 decoration-4">PWNED</span></span>
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
        <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <!-- PRO Card -->
            <div class="pricing-card rounded-lg p-6">
                <div class="bg-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">PRO</div>
                <div class="text-2xl font-bold text-white mb-2">3000 BIRR/month</div>
                <hr class="border-gray-600 mb-4">
                <ul class="text-gray-300 space-y-2 text-sm">
                    <li>• Email monitoring</li>
                    <li>• Basic alerts</li>
                    <li>• Team dashboard</li>
                </ul>
                <button class="w-full mt-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg font-medium transition-all btn-glow">
                    Get Started
                </button>
            </div>

            <!-- PRO PLUS Card -->
            <div class="pricing-card rounded-lg p-6">
                <div class="bg-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">PRO PLUS</div>
                <div class="text-2xl font-bold text-white mb-2">5000 BIRR/month</div>
                <hr class="border-gray-600 mb-4">
                <ul class="text-gray-300 space-y-2 text-sm">
                    <li>• Everything in PRO</li>
                    <li>• Domain monitoring</li>
                    <li>• Advanced analytics</li>
                    <li>• Priority support</li>
                </ul>
                <button class="w-full mt-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg font-medium transition-all btn-glow">
                    Get Started
                </button>
            </div>

            <!-- Custom Card -->
            <div class="pricing-card featured rounded-lg p-6">
                <div class="bg-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">Custom</div>
                <div class="text-2xl font-bold text-white mb-2">Let's Talk!</div>
                <hr class="border-gray-600 mb-4">
                <ul class="text-gray-300 space-y-2 text-sm">
                    <li>• Enterprise features</li>
                    <li>• Custom integrations</li>
                    <li>• Dedicated support</li>
                    <li>• SLA guarantees</li>
                </ul>
                <button class="w-full mt-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg font-medium transition-all btn-glow">
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
                document.querySelectorAll('.pricing-card .text-2xl').forEach(price => {
                    const currentPrice = price.textContent;
                    if (currentPrice.includes('BIRR/month')) {
                        const amount = parseInt(currentPrice.replace(' BIRR/month', ''));
                        const discounted = Math.round(amount * 0.9);
                        price.textContent = `${discounted} BIRR/month`;
                    }
                });
            } else {
                // Reset to original prices
                const prices = ['3000 BIRR/month', '5000 BIRR/month', 'Let\'s Talk!'];
                document.querySelectorAll('.pricing-card .text-2xl').forEach((price, index) => {
                    price.textContent = prices[index];
                });
            }
        }
    </script>
</body>
</html>

