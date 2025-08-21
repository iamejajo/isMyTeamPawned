<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechCorp Inc Data Breach - TEAMPWNED</title>
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

        .stat-card {
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            border: 1px solid rgba(var(--brand-rgb), 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .data-type-badge {
            background: linear-gradient(135deg, rgba(var(--brand-rgb), 0.2), rgba(var(--brand-rgb), 0.1));
            border: 1px solid rgba(var(--brand-rgb), 0.3);
            backdrop-filter: blur(5px);
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
                    <a href="{{ route('breach') }}" class="text-teal-400 font-medium">Breach</a>
                    <a href="{{ route('pricing') }}" class="text-white hover:text-teal-400 transition-colors">Pricing</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 rounded-md text-sm font-medium transition-all btn-glow">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breach Header -->
    <div class="relative">
        <!-- Circuit board background -->
        <div class="absolute inset-0 bg-circuit opacity-40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black"></div>
        <div class="absolute inset-0 spotlight pointer-events-none"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
            <!-- Company Header -->
            <div class="text-center mb-12">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-white">TechCorp Inc</h1>
                        <p class="text-xl text-gray-300">Technology • United States</p>
                    </div>
                </div>
                <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-4 inline-block">
                    <span class="text-red-400 font-semibold">CRITICAL SEVERITY</span>
                </div>
            </div>

            <!-- Breach Statistics -->
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="stat-card rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-red-400 mb-2">15.2M</div>
                    <div class="text-gray-300 text-sm">Affected Accounts</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-orange-400 mb-2">Dec 15, 2023</div>
                    <div class="text-gray-300 text-sm">Breach Date</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-yellow-400 mb-2">5</div>
                    <div class="text-gray-300 text-sm">Data Types Exposed</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-teal-400 mb-2">Active</div>
                    <div class="text-gray-300 text-sm">Status</div>
                </div>
            </div>

            <!-- Compromised Data Types -->
            <div class="content-card rounded-xl p-8 mb-12">
                <h2 class="text-2xl font-bold text-white mb-6">Compromised Data Types</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="data-type-badge rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-envelope text-red-400 mr-3"></i>
                            <span class="text-white font-semibold">Email Addresses</span>
                        </div>
                        <p class="text-gray-300 text-sm">All user email addresses were exposed in the breach</p>
                    </div>
                    <div class="data-type-badge rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-lock text-orange-400 mr-3"></i>
                            <span class="text-white font-semibold">Hashed Passwords</span>
                        </div>
                        <p class="text-gray-300 text-sm">Passwords were hashed using bcrypt encryption</p>
                    </div>
                    <div class="data-type-badge rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user text-yellow-400 mr-3"></i>
                            <span class="text-white font-semibold">Full Names</span>
                        </div>
                        <p class="text-gray-300 text-sm">Complete names of all affected users</p>
                    </div>
                    <div class="data-type-badge rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-phone text-teal-400 mr-3"></i>
                            <span class="text-white font-semibold">Phone Numbers</span>
                        </div>
                        <p class="text-gray-300 text-sm">Contact phone numbers for most users</p>
                    </div>
                    <div class="data-type-badge rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-calendar text-purple-400 mr-3"></i>
                            <span class="text-white font-semibold">Date of Birth</span>
                        </div>
                        <p class="text-gray-300 text-sm">Birth dates for approximately 60% of users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- What Happened Section -->
    <div class="bg-black relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="content-card rounded-xl p-8">
                <h2 class="text-3xl font-bold text-white mb-8">What Happened in the TechCorp Inc Breach?</h2>

                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        On December 15, 2023, TechCorp Inc discovered a massive data breach that compromised the personal information of over 15 million users. The breach represents one of the largest cybersecurity incidents of the year and has raised serious concerns about data protection practices in the technology sector.
                    </p>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">The Attack Vector</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The breach was initiated through a sophisticated cyber attack that exploited a previously unknown vulnerability in TechCorp's authentication system. Security researchers believe the attackers gained initial access through a combination of social engineering tactics and technical exploits, specifically targeting the company's customer database infrastructure.
                    </p>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">Timeline of Events</h3>
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-3 h-3 bg-red-400 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="text-white font-semibold">December 10, 2023</div>
                                <div class="text-gray-300">Initial unauthorized access detected by security systems</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-3 h-3 bg-orange-400 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="text-white font-semibold">December 12, 2023</div>
                                <div class="text-gray-300">Data exfiltration begins, affecting user databases</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="text-white font-semibold">December 15, 2023</div>
                                <div class="text-gray-300">Breach discovered and containment measures implemented</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-3 h-3 bg-teal-400 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="text-white font-semibold">December 18, 2023</div>
                                <div class="text-gray-300">Public disclosure and user notification process begins</div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">Technical Details</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The attackers exploited a zero-day vulnerability in TechCorp's API authentication system, allowing them to bypass security controls and gain administrative access to the customer database. The vulnerability was present in the company's user management system, which had not been properly patched during recent security updates.
                    </p>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">Data Exposure Scope</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        The breach exposed comprehensive user data including email addresses, hashed passwords, full names, phone numbers, and dates of birth. While passwords were properly hashed using bcrypt encryption, the exposure of personal information creates significant privacy and security risks for affected users.
                    </p>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">Company Response</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        TechCorp Inc has responded to the breach by implementing immediate security measures, including system-wide password resets, enhanced monitoring, and the deployment of additional security controls. The company is also working with law enforcement agencies and cybersecurity experts to investigate the incident and prevent future breaches.
                    </p>

                    <h3 class="text-2xl font-bold text-white mb-4 mt-8">Impact on Users</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        Users affected by this breach face increased risks of identity theft, phishing attacks, and account compromise. The exposed information can be used by attackers to conduct targeted attacks, attempt password cracking, or sell the data on underground markets.
                    </p>

                    <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-6 mt-8">
                        <h3 class="text-xl font-bold text-red-400 mb-3">⚠️ Immediate Action Required</h3>
                        <p class="text-gray-300 mb-4">
                            If you have an account with TechCorp Inc, you should take immediate action to protect your information:
                        </p>
                        <ul class="text-gray-300 list-disc list-inside space-y-2">
                            <li>Change your password immediately</li>
                            <li>Enable two-factor authentication if available</li>
                            <li>Monitor your accounts for suspicious activity</li>
                            <li>Check if your email appears in our breach database</li>
                            <li>Consider freezing your credit reports</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent News Section -->
    <div class="bg-black relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <h2 class="text-3xl font-bold text-white mb-8">Recent Security News</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- News Item 1 -->
                <div class="news-card rounded-xl p-6">
                    <span class="text-gray-400 text-sm">2 hours ago</span>
                    <h3 class="text-lg font-bold text-white mb-2 mt-2">
                        Major Data Breach Affects 50 Million Users
                    </h3>
                    <p class="text-gray-300 text-xs mb-3">
                        A significant data breach has been reported affecting millions of users...
                    </p>
                    <span class="text-teal-400 text-sm font-medium">Read More →</span>
                </div>

                <!-- News Item 2 -->
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

                <!-- News Item 3 -->
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
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-8 text-gray-400 text-sm">
        <p>privacy policy and @c2025 ismyteampwned.</p>
    </footer>
</body>
</html>
