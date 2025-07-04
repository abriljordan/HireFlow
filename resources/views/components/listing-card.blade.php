<div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded p-4">
  <div class="flex-initial">
    <img class="hidden w-48 mr-6 md:block" src="{{asset('images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/listings/{{$listing->id}}" class="text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400">{{$listing->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">{{$listing->company}}</div>
      <x-listing-tags :tagsCsv="$listing->tags" />
      <div class="text-lg mt-4 text-gray-700 dark:text-gray-300">
        <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
      </div>
      <div class="text-lg mt-2 text-gray-700 dark:text-gray-300">
        <i class="fa-solid fa-briefcase"></i> {{ucfirst(str_replace('-', ' ', $listing->job_type))}}
      </div>
      <div class="text-lg mt-2 text-gray-700 dark:text-gray-300">
        <i class="fa-solid fa-user-graduate"></i> {{ucfirst($listing->experience_level)}} Level
      </div>
      @if($listing->salary_min && $listing->salary_max)
        <div class="text-lg mt-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-money-bill-wave"></i> ${{ number_format($listing->salary_min) }} - ${{ number_format($listing->salary_max) }}
        </div>
      @elseif($listing->salary_min)
        <div class="text-lg mt-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-money-bill-wave"></i> ${{ number_format($listing->salary_min) }}+
        </div>
      @elseif($listing->salary)
        <div class="text-lg mt-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-money-bill-wave"></i> {{$listing->salary}}
        </div>
      @endif
      <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        <i class="fa-solid fa-clock"></i> Posted {{$listing->created_at->diffForHumans()}}
      </div>
      @if($listing->application_deadline)
      <div class="text-sm mt-2 {{$listing->isApplicationOpen() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}}">
        <i class="fa-solid fa-calendar-times"></i> 
        @if($listing->isApplicationOpen())
          Deadline: {{$listing->getFormattedDeadline()}}
          @if($listing->getDaysUntilDeadline() !== null)
            ({{$listing->getDaysUntilDeadline()}} days left)
          @endif
        @else
          Applications Closed
        @endif
      </div>
      @endif
      <div class="mt-4">
        @if($listing->isApplicationOpen())
          <a href="{{route('listings.apply', $listing->id)}}" class="bg-hireflow text-white px-4 py-2 rounded hover:opacity-80">
            <i class="fa-solid fa-paper-plane"></i> Apply Now
          </a>
        @else
          <button class="bg-gray-400 dark:bg-gray-600 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
            <i class="fa-solid fa-times"></i> Applications Closed
          </button>
        @endif
      </div>
    </div>
  </div>
</div> 