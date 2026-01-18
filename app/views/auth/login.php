<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="flex min-h-screen">
        
        <!-- Left Side: Image & Branding (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900 text-white flex-col justify-center p-12 overflow-hidden">
            <!-- Background Pattern/Image -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop" 
                     alt="Background" class="w-full h-full object-cover opacity-40 mix-blend-overlay">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-900 via-indigo-900/40 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-lg">
                <h2 class="text-4xl font-bold leading-tight mb-4">Welcome back.</h2>
                <p class="text-indigo-200 text-lg">Sign in to continue your progress and access your personalized dashboard.</p>
            </div>

            <!-- Optional Copyright footer -->
            <div class="absolute bottom-12 left-12 z-10 text-sm text-indigo-300">
                &copy; 2024 MyApp Inc. All rights reserved.
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16 bg-gray-50">
            <div class="w-full max-w-md space-y-8">
                
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Don't have an account? 
                        <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">Sign up for free</a>
                    </p>
                </div>

                <!-- Error Alert -->
                <?php if (isset($error)): ?>
                    <div class="rounded-md bg-red-50 p-4 border border-red-200 animate-pulse">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Login Failed</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p><?php echo htmlspecialchars($error); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form class="mt-8 space-y-6" action="/login" method="POST">
                    
                    <div class="space-y-5">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                </div>
                                <input type="email" name="email" id="email" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <input type="password" name="password" id="password" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>