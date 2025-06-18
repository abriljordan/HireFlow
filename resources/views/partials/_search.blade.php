<div class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <form action="/search" method="GET" class="max-w-4xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Search
          </label>
          <input 
            type="text" 
            name="search" 
            id="search"
            value="{{ request('search') }}"
            placeholder="Search for jobs..."
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:text-white"
          >
        </div>
        
        <div>
          <label for="job_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Job Type
          </label>
          <select 
            name="job_type" 
            id="job_type"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:text-white"
          >
            <option value="">All Types</option>
            <option value="full-time" {{ request('job_type') === 'full-time' ? 'selected' : '' }}>Full Time</option>
            <option value="part-time" {{ request('job_type') === 'part-time' ? 'selected' : '' }}>Part Time</option>
            <option value="contract" {{ request('job_type') === 'contract' ? 'selected' : '' }}>Contract</option>
            <option value="freelance" {{ request('job_type') === 'freelance' ? 'selected' : '' }}>Freelance</option>
            <option value="internship" {{ request('job_type') === 'internship' ? 'selected' : '' }}>Internship</option>
          </select>
        </div>
        
        <div>
          <label for="experience_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Experience
          </label>
          <select 
            name="experience_level" 
            id="experience_level"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:text-white"
          >
            <option value="">All Levels</option>
            <option value="entry" {{ request('experience_level') === 'entry' ? 'selected' : '' }}>Entry Level</option>
            <option value="junior" {{ request('experience_level') === 'junior' ? 'selected' : '' }}>Junior</option>
            <option value="mid" {{ request('experience_level') === 'mid' ? 'selected' : '' }}>Mid Level</option>
            <option value="senior" {{ request('experience_level') === 'senior' ? 'selected' : '' }}>Senior</option>
            <option value="lead" {{ request('experience_level') === 'lead' ? 'selected' : '' }}>Lead</option>
            <option value="executive" {{ request('experience_level') === 'executive' ? 'selected' : '' }}>Executive</option>
          </select>
        </div>
        
        <div class="flex items-end">
          <button 
            type="submit"
            class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-md transition-colors"
          >
            <i class="fa-solid fa-search mr-2"></i>
            Search
          </button>
        </div>
      </div>
    </form>
  </div>
</div> 