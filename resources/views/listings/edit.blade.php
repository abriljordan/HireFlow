<x-layout>
  <div class="mx-4">
    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded p-6">
      <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase text-gray-900 dark:text-white">
          Edit Gig
        </h1>
      </header>

      <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6">
          <label for="company" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Company Name <span class="text-red-500 dark:text-red-400">*</span></label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="company" value="{{$listing->company}}" required />

          @error('company')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="title" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Job Title <span class="text-red-500 dark:text-red-400">*</span></label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="title" placeholder="Example: Senior Laravel Developer" value="{{$listing->title}}" required />

          @error('title')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="location" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Job Location <span class="text-red-500 dark:text-red-400">*</span></label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="location" placeholder="Example: Remote, Boston MA, etc" value="{{$listing->location}}" required />

          @error('location')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="email" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Contact Email <span class="text-red-500 dark:text-red-400">*</span></label>
          <input type="email" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="email" value="{{$listing->email}}" required />

          @error('email')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="website" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Website/Application URL <span class="text-red-500 dark:text-red-400">*</span>
          </label>
          <input type="url" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="website" value="{{$listing->website}}" required />

          @error('website')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="salary" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Salary <span class="text-gray-500 dark:text-gray-400">(Optional)</span>
          </label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="salary" placeholder="Example: $50,000 - $70,000, Competitive, Negotiable" value="{{$listing->salary}}" />

          @error('salary')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="job_type" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Job Type <span class="text-red-500 dark:text-red-400">*</span></label>
          <select name="job_type" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
            <option value="">Select Job Type</option>
            <option value="full-time" {{$listing->job_type == 'full-time' ? 'selected' : ''}}>Full-time</option>
            <option value="part-time" {{$listing->job_type == 'part-time' ? 'selected' : ''}}>Part-time</option>
            <option value="contract" {{$listing->job_type == 'contract' ? 'selected' : ''}}>Contract</option>
            <option value="freelance" {{$listing->job_type == 'freelance' ? 'selected' : ''}}>Freelance</option>
            <option value="internship" {{$listing->job_type == 'internship' ? 'selected' : ''}}>Internship</option>
          </select>

          @error('job_type')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="experience_level" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">Experience Level <span class="text-red-500 dark:text-red-400">*</span></label>
          <select name="experience_level" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
            <option value="">Select Experience Level</option>
            <option value="entry" {{$listing->experience_level == 'entry' ? 'selected' : ''}}>Entry Level</option>
            <option value="junior" {{$listing->experience_level == 'junior' ? 'selected' : ''}}>Junior</option>
            <option value="mid" {{$listing->experience_level == 'mid' ? 'selected' : ''}}>Mid Level</option>
            <option value="senior" {{$listing->experience_level == 'senior' ? 'selected' : ''}}>Senior</option>
            <option value="lead" {{$listing->experience_level == 'lead' ? 'selected' : ''}}>Lead</option>
            <option value="executive" {{$listing->experience_level == 'executive' ? 'selected' : ''}}>Executive</option>
          </select>

          @error('experience_level')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="application_deadline" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Application Deadline <span class="text-gray-500 dark:text-gray-400">(Optional)</span>
          </label>
          <input type="date" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="application_deadline" value="{{$listing->application_deadline ? $listing->application_deadline->format('Y-m-d') : ''}}" min="{{date('Y-m-d', strtotime('+1 day'))}}" />

          @error('application_deadline')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="logo" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Company Logo <span class="text-gray-500 dark:text-gray-400">(Optional)</span>
          </label>
          <input type="file" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="logo" accept="image/*" />
          <img class="w-48 mr-6 md:block" src="{{asset('images/no-image.png')}}" alt="" />

          @error('logo')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="tags" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Tags (Comma Separated) <span class="text-red-500 dark:text-red-400">*</span>
          </label>
          <input type="text" class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc" value="{{$listing->tags}}" required />

          @error('tags')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="description" class="inline-block text-lg mb-2 text-gray-700 dark:text-gray-300">
            Job Description <span class="text-red-500 dark:text-red-400">*</span>
          </label>
          <textarea class="border border-gray-200 dark:border-gray-600 rounded p-2 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" name="description" rows="10" placeholder="Include tasks, requirements, salary, etc" required>{{$listing->description}}</textarea>

          @error('description')
          <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white rounded py-2 px-4 transition-colors">
            Update Gig
          </button>

          <a href="/" class="text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 ml-4 transition-colors"> Back </a>
        </div>
      </form>
    </div>
  </div>
</x-layout> 