<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - TEAMPWNED</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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

        /* Spotlight effect for center content */
        .spotlight {
            background: radial-gradient(ellipse at center, rgba(var(--brand-rgb), 0.2) 0%, rgba(var(--brand-rgb), 0.1) 30%, rgba(var(--brand-rgb), 0.05) 50%, transparent 70%);
        }

        /* Dark corners effect */
        .dark-corners {
            background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.8) 100%);
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
                        <a href="{{ route('home') }}">
                            <img src="/images/logo.svg" alt="TEAMPWNED" class="h-8">
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-teal-400 transition-colors">Home</a>
                    <a href="{{ route('news') }}" class="text-white hover:text-teal-400 transition-colors">News</a>
                    <a href="{{ route('breach') }}" class="text-white hover:text-teal-400 transition-colors">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-teal-400 font-medium">Pricing</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 rounded-md text-sm font-medium transition-all btn-glow">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative">
        <!-- Circuit board background -->
        <div class="absolute inset-0 bg-circuit opacity-40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black"></div>
        <div class="absolute inset-0 spotlight pointer-events-none"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6">
                Simple, <span class="text-teal-400">Transparent</span> Pricing
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Choose the perfect plan for your team's security needs. No hidden fees, no surprises.
            </p>
        </div>
    </div>

    <!-- Pricing Section -->
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
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Email monitoring</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Basic alerts</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Team dashboard</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>24/7 support</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Get Started
                </button>
            </div>

            <!-- PRO PLUS Card -->
            <div class="pricing-card rounded-xl p-8">
                <div class="pricing-badge">PRO PLUS</div>
                <div class="pricing-price mb-4">$49<span class="text-lg text-gray-400">/month</span></div>
                <hr class="border-gray-600 mb-6">
                <ul class="text-gray-300 space-y-3 text-sm mb-8">
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Everything in PRO</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Domain monitoring</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Advanced analytics</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Priority support</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Custom integrations</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Get Started
                </button>
            </div>

            <!-- Custom Card -->
            <div class="pricing-card rounded-xl p-8">
                <div class="pricing-badge">Custom</div>
                <div class="pricing-price mb-4">Let's Talk!</div>
                <hr class="border-gray-600 mb-6">
                <ul class="text-gray-300 space-y-3 text-sm mb-8">
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Enterprise features</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Custom integrations</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>Dedicated support</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>SLA guarantees</li>
                    <li class="flex items-center"><span class="text-teal-400 mr-2">✓</span>White-label options</li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Contact Us
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-8 text-gray-400 text-sm">
        <p>privacy policy and @c2025 ismyteampwned.</p>
    </footer>

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
