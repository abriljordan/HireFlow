@if (session()->has('message'))
<div class="fixed top-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg shadow-lg max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('message') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button @click="show = false" class="text-green-400 hover:text-green-600 dark:hover:text-green-300">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@if (session()->has('error'))
<div class="fixed top-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg shadow-lg max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button @click="show = false" class="text-red-400 hover:text-red-600 dark:hover:text-red-300">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endif 