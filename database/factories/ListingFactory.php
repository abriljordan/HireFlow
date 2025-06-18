<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            'laravel, javascript, vue',
            'laravel, backend, api',
            'laravel, php, mysql',
            'laravel, react, frontend',
            'laravel, docker, devops',
            'laravel, testing, phpunit'
        ];

        $companies = [
            'Acme Corp',
            'Stark Industries',
            'Wayne Enterprises',
            'Skynet Systems',
            'Wonka Industries',
            'Cyberdyne Systems'
        ];

        $locations = [
            'Boston, MA',
            'New York, NY',
            'Gotham, NY',
            'Newark, NJ',
            'San Francisco, CA',
            'Austin, TX'
        ];

        $jobTypes = ['full-time', 'part-time', 'contract', 'freelance', 'internship'];
        $experienceLevels = ['entry', 'junior', 'mid', 'senior', 'lead', 'executive'];
        $salaries = [
            '$40,000 - $60,000',
            '$60,000 - $80,000',
            '$80,000 - $120,000',
            '$120,000 - $150,000',
            'Competitive',
            'Negotiable'
        ];

        return [
            'user_id' => User::factory(),
            'title' => fake()->jobTitle(),
            'tags' => fake()->randomElement($tags),
            'company' => fake()->randomElement($companies),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'location' => fake()->randomElement($locations),
            'description' => fake()->paragraph(5),
            'salary' => fake()->randomElement($salaries),
            'job_type' => fake()->randomElement($jobTypes),
            'experience_level' => fake()->randomElement($experienceLevels),
            'application_deadline' => fake()->optional(0.7)->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
        ];
    }
} 