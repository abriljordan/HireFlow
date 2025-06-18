<x-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
      <div class="text-center">
        <div class="text-6xl font-bold text-red-500 mb-4">405</div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
          Method Not Allowed
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          The HTTP method you're trying to use is not supported for this route.
        </p>
        
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-6 text-left">
          <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Debug Information:</h3>
          <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
            <div><strong>Requested URL:</strong> {{ request()->url() }}</div>
            <div><strong>HTTP Method:</strong> {{ request()->method() }}</div>
            <div><strong>Supported Methods:</strong> POST</div>
            <div><strong>Timestamp:</strong> {{ now()->format('Y-m-d H:i:s') }}</div>
          </div>
        </div>
        
        <div class="space-y-3">
          <a href="/" class="block w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
            <i class="fa-solid fa-home mr-2"></i>
            Go to Homepage
          </a>
          <a href="javascript:history.back()" class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go Back
          </a>
        </div>
      </div>
    </div>
  </div>
</x-layout> 