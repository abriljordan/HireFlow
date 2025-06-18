<x-layout>
  @include('partials._hero')
  @include('partials._search')
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
        Latest Job Opportunities
      </h2>
      <p class="text-lg text-gray-600 dark:text-gray-400">
        Discover your next career move with our curated job listings
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($listings as $listing)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
          <div class="p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                  <a href="/listings/{{$listing->id}}" class="hover:text-primary-600 dark:hover:text-primary-400">
                    {{$listing->title}}
                  </a>
                </h3>
                <p class="text-gray-600 dark:text-gray-400 font-medium">{{$listing->company}}</p>
              </div>
              @if($listing->logo)
                <img class="w-12 h-12 rounded-lg object-cover" src="{{asset('storage/' . $listing->logo)}}" alt="{{$listing->company}} logo">
                        @endif
            </div>

            <div class="space-y-3">
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fa-solid fa-location-dot mr-2"></i>
                {{$listing->location}}
              </div>

              <div class="flex items-center justify-between">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                  {{ $listing->job_type === 'full-time' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                     ($listing->job_type === 'part-time' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                     'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') }}">
                  {{ ucfirst(str_replace('-', ' ', $listing->job_type)) }}
                </span>

                @if($listing->salary_min)
                  <span class="text-sm font-medium text-gray-900 dark:text-white">
                    ${{ number_format($listing->salary_min) }}
                    @if($listing->salary_max)
                      - ${{ number_format($listing->salary_max) }}
            @endif
                                </span>
                @endif
              </div>

              <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500 dark:text-gray-400">
                  <i class="fa-solid fa-clock mr-1"></i>
                  {{ $listing->created_at->diffForHumans() }}
                            </span>
                
                @if($listing->application_deadline)
                  <span class="text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-calendar mr-1"></i>
                    {{ $listing->application_deadline->format('M d') }}
                            </span>
                @endif
              </div>
                </div>

            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
              <div class="flex items-center justify-between">
                <x-listing-tags :tagsCsv="$listing->tags" />
                
                <a href="/listings/{{$listing->id}}" 
                   class="inline-flex items-center px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-md transition-colors">
                  View Details
                  <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
              </div>
            </div>
                </div>
        </div>
      @endforeach
        </div>

    <div class="mt-12 text-center">
      <a href="/" 
         class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
        View All Jobs
        <i class="fa-solid fa-arrow-right ml-2"></i>
      </a>
    </div>
  </div>
</x-layout> 