<!DOCTYPE html>
<html lang="en" class="h-full" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); 
              if (darkMode) document.documentElement.classList.add('dark'); 
              else document.documentElement.classList.remove('dark')" 
      :class="{ 'dark': darkMode }">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              primary: {
                50: '#eff6ff',
                100: '#dbeafe',
                200: '#bfdbfe',
                300: '#93c5fd',
                400: '#60a5fa',
                500: '#3b82f6',
                600: '#2563eb',
                700: '#1d4ed8',
                800: '#1e40af',
                900: '#1e3a8a',
                950: '#172554',
              },
              gray: {
                50: '#f9fafb',
                100: '#f3f4f6',
                200: '#e5e7eb',
                300: '#d1d5db',
                400: '#9ca3af',
                500: '#6b7280',
                600: '#4b5563',
                700: '#374151',
                800: '#1f2937',
                900: '#111827',
                950: '#030712',
              },
            },
            fontFamily: {
              sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif'],
            },
          },
        },
      }
  </script>
  <title>HireFlow | Find Your Next Career Opportunity</title>
</head>

<body class="h-full bg-gray-50 dark:bg-gray-900">
  
  <!-- Navigation -->
  <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <a href="/" class="flex-shrink-0">
            <div class="flex items-center space-x-2">
              <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-briefcase text-white text-sm"></i>
              </div>
              <span class="text-xl font-bold text-gray-900 dark:text-white">HireFlow</span>
            </div>
          </a>
        </div>
        
        <div class="flex items-center space-x-4">
          <!-- Theme Toggle -->
          <button @click="darkMode = !darkMode; 
                         if (darkMode) document.documentElement.classList.add('dark'); 
                         else document.documentElement.classList.remove('dark')" 
                  class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
            <i class="fa-solid fa-sun" x-show="!darkMode"></i>
            <i class="fa-solid fa-moon" x-show="darkMode"></i>
          </button>
          
          @auth
            <div class="flex items-center space-x-4">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                Welcome {{auth()->user()->name}}
              </span>
              @if(auth()->id() == 1)
                <a href="/admin" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 text-sm font-medium">
                  <i class="fa-solid fa-crown mr-1"></i> Admin
                </a>
              @endif
              <a href="/listings/manage" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">
                <i class="fa-solid fa-gear mr-1"></i> Manage Listings
              </a>
              <form class="inline" method="POST" action="/logout">
                @csrf
                <button type="submit" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 text-sm font-medium">
                  <i class="fa-solid fa-sign-out-alt mr-1"></i> Logout
                </button>
              </form>
            </div>
          @else
            <div class="flex items-center space-x-4">
              <a href="/register" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">
                <i class="fa-solid fa-user-plus mr-1"></i> Register
              </a>
              <a href="/login" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">
                <i class="fa-solid fa-sign-in-alt mr-1"></i> Login
              </a>
            </div>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="min-h-screen bg-gray-50 dark:bg-gray-900">
    {{$slot}}
  </main>

  <!-- Footer -->
  <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex items-center justify-between">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          Copyright &copy; 2024 HireFlow, All Rights reserved
        </p>
        
        @auth
          <a href="/listings/create" 
             class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <i class="fa-solid fa-plus mr-2"></i>
            Post Job
          </a>
        @else
          <a href="/register" 
             class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <i class="fa-solid fa-user-plus mr-2"></i>
            Get Started
          </a>
        @endauth
      </div>
    </div>
  </footer>

  <x-flash-message />
</body>

</html> 