<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breach Database - TEAMPWNED</title>
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

        /* Spotlight effect for center content */
        .spotlight {
            background: radial-gradient(ellipse at center, rgba(var(--brand-rgb), 0.2) 0%, rgba(var(--brand-rgb), 0.1) 30%, rgba(var(--brand-rgb), 0.05) 50%, transparent 70%);
        }

        /* Dark corners effect */
        .dark-corners {
            background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.8) 100%);
        }

        .breach-card {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .breach-card:hover {
            border-color: var(--brand-primary);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(var(--brand-rgb), 0.1), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .search-box {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.2);
            backdrop-filter: blur(10px);
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

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-teal-400 transition-colors">Home</a>
                    <a href="{{ route('news') }}" class="text-white hover:text-teal-400 transition-colors">News</a>
                    <a href="{{ route('breach') }}" class="text-teal-400 font-medium">Breach</a>
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
                    <a href="{{ route('home') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Home</a>
                    <a href="{{ route('news') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">News</a>
                    <a href="{{ route('breach') }}" class="text-teal-400 block px-3 py-2 text-base font-medium">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Pricing</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 block px-3 py-2 text-base font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 hover:bg-teal-800 text-white block px-3 py-2 text-base font-medium transition-all btn-glow">Register</a>
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
                Breach <span class="text-teal-400">Database</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
            All recorded leaks stored in our system.
            </p>
        </div>
    </div>

    <!-- Breach Database Section -->
    <div class="bg-black relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Statistics -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-8">Database Statistics</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-teal-400 mb-2">1,234</div>
                        <div class="text-gray-300 text-sm">Total Breaches</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-teal-400 mb-2">2.5B+</div>
                        <div class="text-gray-300 text-sm">Records Exposed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-teal-400 mb-2">567</div>
                        <div class="text-gray-300 text-sm">Companies Affected</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-teal-400 mb-2">89</div>
                        <div class="text-gray-300 text-sm">Countries Impacted</div>
                    </div>
                </div>
            </div>

            <!-- Recent Breaches -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-white mb-8">Breached Organizations</h2>

                <!-- Breached Organizations List -->
                <div class="breach-card rounded-xl overflow-hidden">
                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-teal-900/50 to-teal-800/50 px-6 py-4 border-b border-teal-500/20">
                        <div class="grid grid-cols-3 gap-4 text-sm font-semibold text-white">
                            <div class="flex items-center">
                                <span>Organization Name</span>
                                <i class="fas fa-sort ml-2 text-teal-400 cursor-pointer"></i>
                            </div>
                            <div class="flex items-center justify-center">
                                <span>Pwned Count</span>
                                <i class="fas fa-sort ml-2 text-teal-400 cursor-pointer"></i>
                            </div>
                            <div class="flex items-center justify-end">
                                <span>Breach Date</span>
                                <i class="fas fa-sort ml-2 text-teal-400 cursor-pointer"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-gray-700">
                        <!-- Row 1 -->
                        <a href="{{ route('breach.detail', 1) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">TechCorp Inc</div>
                                            <div class="text-gray-400 text-xs">Technology</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-red-400 font-bold">15.2M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Dec 15, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 2 -->
                        <a href="{{ route('breach.detail', 2) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">FinanceBank</div>
                                            <div class="text-gray-400 text-xs">Financial Services</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-orange-400 font-bold">2.8M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Nov 28, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 3 -->
                        <a href="{{ route('breach.detail', 3) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">SocialMedia Platform</div>
                                            <div class="text-gray-400 text-xs">Social Media</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-red-400 font-bold">250M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Oct 12, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 4 -->
                        <a href="{{ route('breach.detail', 4) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">CloudProvider</div>
                                            <div class="text-gray-400 text-xs">Cloud Services</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-yellow-400 font-bold">100M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Sep 05, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 5 -->
                        <a href="{{ route('breach.detail', 5) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">E-commerce Giant</div>
                                            <div class="text-gray-400 text-xs">Retail</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-red-400 font-bold">75M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Aug 22, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 6 -->
                        <a href="{{ route('breach.detail', 6) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">Healthcare Network</div>
                                            <div class="text-gray-400 text-xs">Healthcare</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-orange-400 font-bold">8.5M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Jul 18, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 7 -->
                        <a href="{{ route('breach.detail', 7) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">Gaming Studio</div>
                                            <div class="text-gray-400 text-xs">Entertainment</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-yellow-400 font-bold">12M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        Jun 30, 2023
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Row 8 -->
                        <a href="{{ route('breach.detail', 8) }}" class="block hover:bg-gray-800/30 transition-colors">
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4 items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">Telecom Provider</div>
                                            <div class="text-gray-400 text-xs">Telecommunications</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-red-400 font-bold">45M</span>
                                        <div class="text-gray-400 text-xs">records</div>
                                    </div>
                                    <div class="text-right text-gray-300 text-sm">
                                        May 14, 2023
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-teal-700 text-white rounded-lg">1</button>
                        <button class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">2</button>
                        <button class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">3</button>
                        <span class="text-gray-400 px-2">...</span>
                        <button class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">15</button>
                        <button class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Top Breaches by Impact -->
            <div class="mt-20">
                <h2 class="text-3xl font-bold text-white mb-8">Top Breaches by Impact</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Top Breach 1 -->
                    <a href="{{ route('breach.detail', 3) }}" class="block">
                        <div class="breach-card rounded-xl p-6 hover:border-teal-400 transition-all group">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-400 text-sm">2023</span>
                            </div>
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-white">SocialMedia Platform</h3>
                                <div class="text-gray-400 text-xs">Social Media</div>
                            </div>
                            <div class="text-2xl font-bold text-teal-400 mb-2">250M+</div>
                            <div class="text-gray-300 text-xs mb-3">Records exposed in the largest breach of 2023</div>
                            <span class="text-teal-400 text-sm font-medium group-hover:text-teal-300 transition-colors">View Details →</span>
                        </div>
                    </a>

                    <!-- Top Breach 2 -->
                    <a href="{{ route('breach.detail', 1) }}" class="block">
                        <div class="breach-card rounded-xl p-6 hover:border-teal-400 transition-all group">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-400 text-sm">2023</span>
                            </div>
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-white">TechCorp Inc</h3>
                                <div class="text-gray-400 text-xs">Technology</div>
                            </div>
                            <div class="text-2xl font-bold text-teal-400 mb-2">15.2M+</div>
                            <div class="text-gray-300 text-xs mb-3">Recent critical breach with widespread impact</div>
                            <span class="text-teal-400 text-sm font-medium group-hover:text-teal-300 transition-colors">View Details →</span>
                        </div>
                    </a>

                    <!-- Top Breach 3 -->
                    <a href="{{ route('breach.detail', 4) }}" class="block">
                        <div class="breach-card rounded-xl p-6 hover:border-teal-400 transition-all group">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-400 text-sm">2023</span>
                            </div>
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-white">CloudProvider</h3>
                                <div class="text-gray-400 text-xs">Cloud Services</div>
                            </div>
                            <div class="text-2xl font-bold text-teal-400 mb-2">100M+</div>
                            <div class="text-gray-300 text-xs mb-3">Configuration error led to data exposure</div>
                            <span class="text-teal-400 text-sm font-medium group-hover:text-teal-300 transition-colors">View Details →</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-8 text-gray-400 text-sm">
        <p>privacy policy and @c2025 ismyteampwned.</p>
    </footer>

    <script>
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
