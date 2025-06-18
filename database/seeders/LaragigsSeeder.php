<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaragigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user or use existing one
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create another test user
        $user2 = User::firstOrCreate(
            ['email' => 'jane@example.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Sample listings data with all new fields
        $listings = [
            [
                'title' => 'Laravel Senior Developer',
                'tags' => 'laravel, javascript',
                'company' => 'Acme Corp',
                'location' => 'Boston, MA',
                'email' => 'jobs@acme.com',
                'website' => 'https://www.acme.com',
                'description' => 'We are looking for a senior Laravel developer to join our team. You will be responsible for building and maintaining web applications using Laravel framework.',
                'requirements' => '5+ years of experience with Laravel, PHP, MySQL, JavaScript. Experience with Vue.js or React is a plus.',
                'benefits' => 'Competitive salary, health insurance, 401k, flexible work hours, remote work options.',
                'job_type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 80000,
                'salary_max' => 120000,
                'application_deadline' => now()->addDays(30),
                'is_active' => true,
                'user_id' => $user->id
            ],
            [
                'title' => 'Full-Stack Engineer',
                'tags' => 'laravel, backend, api',
                'company' => 'Stark Industries',
                'location' => 'New York, NY',
                'email' => 'careers@stark.com',
                'website' => 'https://www.starkindustries.com',
                'description' => 'Join our innovative team as a Full-Stack Engineer. You will work on cutting-edge projects and help shape the future of technology.',
                'requirements' => '3+ years of experience with Laravel, React, Node.js. Strong understanding of REST APIs and database design.',
                'benefits' => 'Excellent benefits package, stock options, gym membership, free lunch.',
                'job_type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 90000,
                'salary_max' => 130000,
                'application_deadline' => now()->addDays(45),
                'is_active' => true,
                'user_id' => $user->id
            ],
            [
                'title' => 'Laravel Developer',
                'tags' => 'laravel, vue, javascript',
                'company' => 'Wayne Enterprises',
                'location' => 'Gotham, NY',
                'email' => 'hr@wayne.com',
                'website' => 'https://www.wayneenterprises.com',
                'description' => 'We are seeking a Laravel developer to help us build robust web applications. This is a great opportunity to work with modern technologies.',
                'requirements' => '2+ years of Laravel experience, Vue.js knowledge, Git workflow, testing experience.',
                'benefits' => 'Health insurance, dental, vision, paid time off, professional development.',
                'job_type' => 'contract',
                'experience_level' => 'junior',
                'salary_min' => 60000,
                'salary_max' => 80000,
                'application_deadline' => now()->addDays(20),
                'is_active' => true,
                'user_id' => $user2->id
            ],
            [
                'title' => 'Backend Developer',
                'tags' => 'laravel, php, api',
                'company' => 'Skynet Systems',
                'location' => 'Newark, NJ',
                'email' => 'jobs@skynet.com',
                'website' => 'https://www.skynet.com',
                'description' => 'Join our backend team to build scalable APIs and microservices. We work with cutting-edge technologies.',
                'requirements' => '4+ years of PHP/Laravel experience, API design, microservices architecture, Docker knowledge.',
                'benefits' => 'Competitive salary, remote work, flexible hours, health benefits.',
                'job_type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 100000,
                'salary_max' => 150000,
                'application_deadline' => now()->addDays(60),
                'is_active' => true,
                'user_id' => $user->id
            ],
            [
                'title' => 'Junior Developer',
                'tags' => 'laravel, php, javascript',
                'company' => 'Wonka Industries',
                'location' => 'Boston, MA',
                'email' => 'careers@wonka.com',
                'website' => 'https://www.wonka.com',
                'description' => 'Perfect opportunity for a junior developer to learn and grow. We provide mentorship and training.',
                'requirements' => 'Basic knowledge of PHP, HTML, CSS, JavaScript. Eager to learn Laravel framework.',
                'benefits' => 'Training program, mentorship, health insurance, fun work environment.',
                'job_type' => 'part-time',
                'experience_level' => 'entry',
                'salary_min' => 40000,
                'salary_max' => 55000,
                'application_deadline' => now()->addDays(15),
                'is_active' => true,
                'user_id' => $user2->id
            ],
            [
                'title' => 'Freelance Laravel Developer',
                'tags' => 'laravel, freelance, remote',
                'company' => 'Tech Solutions Inc',
                'location' => 'Remote',
                'email' => 'projects@techsolutions.com',
                'website' => 'https://www.techsolutions.com',
                'description' => 'We are looking for a freelance Laravel developer to work on various client projects. Flexible hours and remote work.',
                'requirements' => '3+ years of Laravel experience, ability to work independently, good communication skills.',
                'benefits' => 'Flexible hours, remote work, competitive hourly rate, project variety.',
                'job_type' => 'freelance',
                'experience_level' => 'mid',
                'salary_min' => 50,
                'salary_max' => 80,
                'application_deadline' => now()->addDays(90),
                'is_active' => true,
                'user_id' => $user->id
            ]
        ];

        // Create listings (only if they don't exist)
        foreach ($listings as $listingData) {
            Listing::firstOrCreate(
                [
                    'title' => $listingData['title'],
                    'company' => $listingData['company'],
                    'user_id' => $listingData['user_id']
                ],
                $listingData
            );
        }
    }
} 