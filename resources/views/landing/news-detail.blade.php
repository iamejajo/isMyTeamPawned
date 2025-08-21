<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Major Data Breach Affects 50 Million Users - TEAMPWNED</title>
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

        .content-card {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
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

    <!-- Article Content -->
    <div class="relative">
        <!-- Circuit board background -->
        <div class="absolute inset-0 bg-circuit opacity-40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black"></div>
        <div class="absolute inset-0 spotlight pointer-events-none"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
            <!-- Article Header -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full mr-3">BREAKING</span>
                    <span class="text-gray-400 text-sm">2 hours ago</span>
                    <span class="text-gray-400 text-sm mx-2">•</span>
                    <span class="text-gray-400 text-sm">By Security Team</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Major Data Breach Affects 50 Million Users Worldwide
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    A significant data breach has been reported affecting millions of users across multiple countries. The breach includes sensitive personal information and has raised serious concerns about data security.
                </p>
            </div>

            <!-- Article Body -->
            <div class="content-card rounded-xl p-8 mb-12">
                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        In what security experts are calling one of the largest data breaches of the year, a major technology company has confirmed that approximately 50 million user accounts have been compromised. The breach, which was discovered late last week, has exposed a wide range of sensitive information including email addresses, hashed passwords, and personal identification data.
                    </p>

                    <h2 class="text-2xl font-bold text-white mb-4 mt-8">What We Know So Far</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The breach appears to have occurred through a sophisticated cyber attack that exploited a previously unknown vulnerability in the company's authentication system. Security researchers believe the attackers gained access to the company's internal systems through a combination of social engineering and technical exploits.
                    </p>

                    <h2 class="text-2xl font-bold text-white mb-4 mt-8">Impact Assessment</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The compromised data includes:
                    </p>
                    <ul class="text-gray-300 text-lg leading-relaxed mb-6 list-disc list-inside space-y-2">
                        <li>Email addresses and usernames</li>
                        <li>Hashed passwords (using bcrypt encryption)</li>
                        <li>Full names and contact information</li>
                        <li>Account creation dates and last login timestamps</li>
                        <li>Profile information and preferences</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-white mb-4 mt-8">Company Response</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The affected company has issued a statement acknowledging the breach and has begun notifying affected users. They have also implemented additional security measures and are working with law enforcement agencies to investigate the incident.
                    </p>

                    <h2 class="text-2xl font-bold text-white mb-4 mt-8">What Users Should Do</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        If you believe your account may have been affected, security experts recommend:
                    </p>
                    <ul class="text-gray-300 text-lg leading-relaxed mb-6 list-disc list-inside space-y-2">
                        <li>Change your password immediately</li>
                        <li>Enable two-factor authentication if available</li>
                        <li>Monitor your accounts for suspicious activity</li>
                        <li>Check if your email appears in our breach database</li>
                        <li>Consider using a password manager for better security</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-white mb-4 mt-8">Ongoing Investigation</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The investigation is ongoing, and more details are expected to emerge in the coming days. Security researchers are analyzing the attack methods used and working to prevent similar breaches in the future.
                    </p>

                    <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-6 mt-8">
                        <h3 class="text-xl font-bold text-red-400 mb-3">⚠️ Security Alert</h3>
                        <p class="text-gray-300">
                            This breach represents a significant security threat. We recommend all users check if their information has been compromised using our breach database and take immediate action to secure their accounts.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Share and Tags -->
            <div class="flex flex-wrap items-center justify-between mb-12">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400 text-sm">Share:</span>
                    <button class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </button>
                    <button class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fab fa-linkedin text-xl"></i>
                    </button>
                    <button class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fas fa-envelope text-xl"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-400 text-sm">Tags:</span>
                    <span class="bg-teal-900/50 text-teal-400 px-2 py-1 rounded text-xs">Data Breach</span>
                    <span class="bg-teal-900/50 text-teal-400 px-2 py-1 rounded text-xs">Security</span>
                    <span class="bg-teal-900/50 text-teal-400 px-2 py-1 rounded text-xs">Cybersecurity</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Related News Section -->
    <div class="bg-black relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <h2 class="text-3xl font-bold text-white mb-8">Related News</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Related Article 1 -->
                <div class="news-card rounded-xl p-6">
                    <span class="text-gray-400 text-sm">1 day ago</span>
                    <h3 class="text-lg font-bold text-white mb-2 mt-2">
                        New Phishing Campaign Targets Corporate Email
                    </h3>
                    <p class="text-gray-300 text-xs mb-3">
                        Security researchers have identified a sophisticated phishing campaign...
                    </p>
                    <span class="text-teal-400 text-sm font-medium">Read More →</span>
                </div>

                <!-- Related Article 2 -->
                <div class="news-card rounded-xl p-6">
                    <span class="text-gray-400 text-sm">3 days ago</span>
                    <h3 class="text-lg font-bold text-white mb-2 mt-2">
                        Zero-Day Vulnerability Discovered
                    </h3>
                    <p class="text-gray-300 text-xs mb-3">
                        A critical zero-day vulnerability has been discovered that affects...
                    </p>
                    <span class="text-teal-400 text-sm font-medium">Read More →</span>
                </div>

                <!-- Related Article 3 -->
                <div class="news-card rounded-xl p-6">
                    <span class="text-gray-400 text-sm">1 week ago</span>
                    <h3 class="text-lg font-bold text-white mb-2 mt-2">
                        Ransomware Attacks on Healthcare Sector
                    </h3>
                    <p class="text-gray-300 text-xs mb-3">
                        Healthcare organizations are experiencing a surge in ransomware...
                    </p>
                    <span class="text-teal-400 text-sm font-medium">Read More →</span>
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
