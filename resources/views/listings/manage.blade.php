<x-layout>
  <div class="mx-4">
    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded p-6">
      <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase text-gray-900 dark:text-white">
          Manage Gigs
        </h1>
      </header>

      @unless($listings->isEmpty())

      <table class="w-full table-auto rounded-sm">
        <tbody>
          @foreach($listings as $listing)
          <tr class="border-gray-300 dark:border-gray-600">
            <td class="px-4 py-8 border-t border-b border-gray-300 dark:border-gray-600 text-lg">
              <a href="/listings/{{$listing->id}}" class="text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400">
                {{$listing->title}}
              </a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 dark:border-gray-600 text-lg">
              <a href="/listings/{{$listing->id}}/edit" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 px-6 py-2 rounded-xl transition-colors">
                <i class="fa-solid fa-edit"></i> Edit
              </a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 dark:border-gray-600 text-lg">
              <form method="POST" action="/listings/{{$listing->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @else
      <p class="text-center text-gray-700 dark:text-gray-300">No listings found</p>
      @endunless
    </div>
  </div>
</x-layout> 