<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Petrol Station Monitor') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <i class="fas fa-gas-pump text-blue-600 text-2xl mr-2"></i>
                                <span class="text-xl font-semibold text-gray-900 dark:text-white">{{ config('app.name', 'Petrol Station Monitor') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white px-3 py-2">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white px-3 py-2">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white px-3 py-2">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 px-3 py-2">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Hero Section -->
                <div class="text-center mb-16">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        Petrol Station Monitoring System
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                        Streamline your petrol station operations with real-time monitoring and efficient management
                    </p>
                    @guest
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Get Started
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                Sign Up
                            </a>
                        </div>
                    @endguest
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Feature 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="text-blue-600 dark:text-blue-400 mb-4">
                            <i class="fas fa-gas-pump text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Real-time Monitoring
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Track fuel levels, sales, and station activities in real-time with our intuitive dashboard
                        </p>
                    </div>
                    <!-- Feature 2 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="text-blue-600 dark:text-blue-400 mb-4">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Analytics & Reports
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Generate detailed reports and insights to make data-driven decisions
                        </p>
                    </div>
                    <!-- Feature 3 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="text-blue-600 dark:text-blue-400 mb-4">
                            <i class="fas fa-bell text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Alert System
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Get instant notifications for low fuel levels and critical events
                        </p>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-blue-600 dark:bg-blue-700 rounded-lg shadow-xl p-8 text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">
                        Ready to optimize your station management?
                    </h2>
                    <p class="text-blue-100 mb-6">
                        Join hundreds of station owners who trust our platform for their daily operations
                    </p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50">
                            Start Free Trial
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-16 py-8 border-t border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Petrol Station Monitor') }}. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>