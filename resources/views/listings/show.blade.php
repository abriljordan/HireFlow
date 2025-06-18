<x-layout>
  <a href="/" class="inline-block text-black dark:text-white ml-4 mb-4 hover:text-primary-600 dark:hover:text-primary-400">
    <i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded p-6">
      <div class="flex flex-col items-center justify-center text-center">
        <img class="w-48 mr-6 md:block" src="{{asset('images/no-image.png')}}" alt="" />
        <h3 class="text-2xl font-bold mb-2 text-gray-900 dark:text-white">{{$listing->title}}</h3>
        <div class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">{{$listing->company}}</div>
        <x-listing-tags :tagsCsv="$listing->tags" />
        <div class="text-lg my-4 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
        </div>
        <div class="text-lg my-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-briefcase"></i> {{ucfirst(str_replace('-', ' ', $listing->job_type))}}
        </div>
        <div class="text-lg my-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-user-graduate"></i> {{ucfirst($listing->experience_level)}} Level
        </div>
        @if($listing->salary)
        <div class="text-lg my-2 text-gray-700 dark:text-gray-300">
          <i class="fa-solid fa-money-bill-wave"></i> {{$listing->salary}}
        </div>
        @endif
        <div class="text-sm text-gray-500 dark:text-gray-400 my-2">
          <i class="fa-solid fa-clock"></i> Posted {{$listing->created_at->diffForHumans()}}
        </div>
        @if($listing->application_deadline)
        <div class="text-lg my-2 {{$listing->isApplicationOpen() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}}">
          <i class="fa-solid fa-calendar-times"></i> 
          @if($listing->isApplicationOpen())
            Application Deadline: {{$listing->getFormattedDeadline()}}
            @if($listing->getDaysUntilDeadline() !== null)
              ({{$listing->getDaysUntilDeadline()}} days left)
            @endif
          @else
            Applications Closed
          @endif
        </div>
        @endif
        <div class="border border-gray-200 dark:border-gray-600 w-full mb-6"></div>
        <div>
          <h3 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
            Job Description
          </h3>
          <div class="text-lg space-y-6 text-gray-700 dark:text-gray-300">
            {{$listing->description}}

            <div class="flex flex-col sm:flex-row gap-4 mt-6">
              @if($listing->isApplicationOpen())
                <a href="{{route('listings.apply', $listing->id)}}" class="bg-hireflow text-white py-3 px-6 rounded-xl hover:opacity-80 text-center">
                  <i class="fa-solid fa-paper-plane"></i> Apply Now
                </a>
              @else
                <button class="bg-gray-400 dark:bg-gray-600 text-white py-3 px-6 rounded-xl cursor-not-allowed" disabled>
                  <i class="fa-solid fa-times"></i> Applications Closed
                </button>
              @endif

              <a href="mailto:{{$listing->email}}" class="bg-gray-600 dark:bg-gray-700 text-white py-3 px-6 rounded-xl hover:opacity-80 text-center">
                <i class="fa-solid fa-envelope"></i> Contact Employer
              </a>

              <a href="{{$listing->website}}" target="_blank" class="bg-black dark:bg-gray-900 text-white py-3 px-6 rounded-xl hover:opacity-80 text-center">
                <i class="fa-solid fa-globe"></i> Visit Website
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout> 