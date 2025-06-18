<x-layout>
  <div class="mx-4">
    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded p-6">
      <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase text-gray-900 dark:text-white">
          Register
        </h1>
      </header>

      <form method="POST" action="/users">
        @csrf
        <div class="mb-6">
          <label for="name" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Name</label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="name" value="{{old('name')}}" />

          @error('name')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="email" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Email</label>
          <input type="email" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="email" value="{{old('email')}}" />

          @error('email')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Password
          </label>
          <input type="password" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="password" value="{{old('password')}}" />

          @error('password')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password2" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Confirm Password
          </label>
          <input type="password" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="password_confirmation" value="{{old('password_confirmation')}}" />

          @error('password_confirmation')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white rounded py-2 px-4 transition-colors">
            Sign Up
          </button>
        </div>

        <div class="mt-8">
          <p class="text-gray-700 dark:text-gray-300">
            Already have an account?
            <a href="/login" class="text-hireflow hover:text-primary-700 dark:hover:text-primary-400 transition-colors">Login</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</x-layout> 