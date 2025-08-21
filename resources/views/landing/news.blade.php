<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - TEAMPWNED</title>
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

        .news-card {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .news-card:hover {
            border-color: var(--brand-primary);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(var(--brand-rgb), 0.1), 0 8px 32px rgba(0, 0, 0, 0.4);
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
                    <a href="{{ route('news') }}" class="text-teal-400 font-medium">News</a>
                    <a href="{{ route('breach') }}" class="text-white hover:text-teal-400 transition-colors">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-white hover:text-teal-400 transition-colors">Pricing</a>
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
                Latest <span class="text-teal-400">Security</span> News
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Stay informed about the latest data breaches, security threats, and cybersecurity trends.
            </p>
        </div>
    </div>

    <!-- News Section -->
    <div class="bg-black relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Featured News -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-white mb-8">Featured Stories</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Featured Article 1 -->
                    <a href="{{ route('news.detail', 1) }}" class="block">
                        <div class="news-card rounded-xl p-8 hover:border-teal-400 transition-all">
                            <div class="flex items-center mb-4">
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full mr-3">BREAKING</span>
                                <span class="text-gray-400 text-sm">2 hours ago</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                Major Data Breach Affects 50 Million Users
                            </h3>
                            <p class="text-gray-300 text-sm mb-4">
                                A significant data breach has been reported affecting millions of users worldwide. The breach includes email addresses, passwords, and personal information...
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-teal-400 text-sm font-medium">Read More →</span>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-share-alt text-gray-400 text-sm"></i>
                                    <i class="fas fa-bookmark text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Featured Article 2 -->
                    <a href="{{ route('news.detail', 2) }}" class="block">
                        <div class="news-card rounded-xl p-8 hover:border-teal-400 transition-all">
                            <div class="flex items-center mb-4">
                                <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full mr-3">ALERT</span>
                                <span class="text-gray-400 text-sm">5 hours ago</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                New Phishing Campaign Targets Corporate Email
                            </h3>
                            <p class="text-gray-300 text-sm mb-4">
                                Security researchers have identified a sophisticated phishing campaign specifically targeting corporate email accounts with advanced social engineering tactics...
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-teal-400 text-sm font-medium">Read More →</span>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-share-alt text-gray-400 text-sm"></i>
                                    <i class="fas fa-bookmark text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent News -->
            <div>
                <h2 class="text-3xl font-bold text-white mb-8">Recent Updates</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- News Item 1 -->
                    <a href="{{ route('news.detail', 3) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">1 day ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                Zero-Day Vulnerability Discovered in Popular Software
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                A critical zero-day vulnerability has been discovered that affects millions of users...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>

                    <!-- News Item 2 -->
                    <a href="{{ route('news.detail', 4) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">2 days ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                Government Agencies Issue Cybersecurity Guidelines
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                New cybersecurity guidelines have been issued for organizations handling sensitive data...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>

                    <!-- News Item 3 -->
                    <a href="{{ route('news.detail', 5) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">3 days ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                Ransomware Attacks on Healthcare Sector Increase
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                Healthcare organizations are experiencing a surge in ransomware attacks...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>

                    <!-- News Item 4 -->
                    <a href="{{ route('news.detail', 6) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">4 days ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                New AI-Powered Security Tools Released
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                Several companies have released new AI-powered security monitoring tools...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>

                    <!-- News Item 5 -->
                    <a href="{{ route('news.detail', 7) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">5 days ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                Cryptocurrency Exchange Security Breach
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                A major cryptocurrency exchange has reported a security breach affecting user funds...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>

                    <!-- News Item 6 -->
                    <a href="{{ route('news.detail', 8) }}" class="block">
                        <div class="news-card rounded-xl p-6 hover:border-teal-400 transition-all">
                            <span class="text-gray-400 text-sm">1 week ago</span>
                            <h3 class="text-lg font-bold text-white mb-2 mt-2">
                                IoT Device Vulnerabilities Exposed
                            </h3>
                            <p class="text-gray-300 text-xs mb-3">
                                Researchers have discovered critical vulnerabilities in popular IoT devices...
                            </p>
                            <span class="text-teal-400 text-sm font-medium">Read More →</span>
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
</body>
</html>
