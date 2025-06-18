# HireFlow - Job Board Application

A modern, full-featured job board application built with Laravel and Filament Admin Panel. HireFlow connects job seekers with employers through an intuitive platform with advanced search, filtering, and application management.

![HireFlow Logo](https://img.shields.io/badge/HireFlow-Job%20Board-blue?style=for-the-badge&logo=laravel)

## 🚀 Features

### For Job Seekers
- **Advanced Job Search** - Search by keywords, job type, experience level, and location
- **Salary Information** - View salary ranges and compensation details
- **Application Tracking** - Apply directly to jobs with deadline tracking
- **Job Filtering** - Filter by multiple criteria including date posted
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile

### For Employers
- **Job Posting** - Create detailed job listings with rich descriptions
- **Application Management** - Track and manage job applications
- **Company Profiles** - Showcase your company with logos and details
- **Deadline Management** - Set application deadlines with automatic status updates

### Admin Features
- **Filament Admin Panel** - Powerful admin interface for managing the platform
- **Analytics Dashboard** - View job statistics, user activity, and salary distributions
- **User Management** - Manage users, listings, and platform settings
- **Real-time Charts** - Visualize data with interactive charts and graphs

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Templates with Tailwind CSS
- **Admin Panel**: Filament 3
- **Database**: PostgreSQL/MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Font Awesome
- **Charts**: Chart.js via Filament

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- PostgreSQL or MySQL
- Web server (Apache/Nginx)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd codehustle
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   ```bash
   # Update .env with your database credentials
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hireflow
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🎯 Usage

### For Job Seekers
1. Visit the homepage to browse all available jobs
2. Use the search filters to find specific positions
3. Click on job titles to view detailed descriptions
4. Apply for jobs using the "Apply Now" button
5. Track application deadlines and status

### For Employers
1. Register an account or log in
2. Click "Post a Job" to create new listings
3. Fill in job details including salary, requirements, and deadline
4. Manage your posted jobs from the dashboard
5. Review and respond to applications

### For Administrators
1. Access the admin panel at `/admin`
2. View analytics and platform statistics
3. Manage users, listings, and system settings
4. Monitor platform activity and performance

## 📊 Database Structure

### Key Tables
- `users` - User accounts and authentication
- `listings` - Job postings with detailed information
- `password_resets` - Password reset functionality
- `failed_jobs` - Queue job management
- `personal_access_tokens` - API authentication

### Listing Fields
- Basic info: title, company, location, description
- Job details: job_type, experience_level, salary_min/max
- Application: application_deadline, contact information
- Metadata: tags, logo, user_id, timestamps

## 🎨 Customization

### Styling
- Modify Tailwind CSS classes in Blade templates
- Update color scheme in `tailwind.config.js`
- Customize Filament theme in `config/filament.php`

### Features
- Add new job types in the migration and factory files
- Extend search functionality in `ListingController`
- Create additional admin widgets in `app/Filament/Widgets/`

## 🔧 Development

### Running Tests
```bash
php artisan test
```

### Code Quality
```bash
# Install Laravel Pint for code styling
composer require laravel/pint --dev
./vendor/bin/pint
```

### Database Seeding
```bash
# Seed with sample data
php artisan db:seed --class=LaragigsSeeder
```

## 📈 Analytics & Monitoring

The admin dashboard includes:
- **Stats Overview** - Total jobs, users, and applications
- **Latest Listings** - Recent job postings
- **Job Type Chart** - Distribution of job types
- **User Activity Chart** - User engagement over time
- **Salary Distribution Chart** - Salary range analysis

## 🔒 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- Authentication middleware
- Secure file uploads
- SQL injection prevention via Eloquent ORM

## 🌟 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Support

For support and questions:
- Create an issue in the repository
- Check the Laravel documentation
- Review Filament documentation for admin panel questions

---

**Built with ❤️ using Laravel and Filament**
