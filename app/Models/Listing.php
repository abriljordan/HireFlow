<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'company',
        'location',
        'website',
        'email',
        'description',
        'tags',
        'logo',
        'user_id',
        'salary',
        'job_type',
        'experience_level',
        'application_deadline'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'application_deadline' => 'date',
    ];

    /**
     * Scope for filtering listings by tag, search, job_type, experience_level, and date
     */
    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }

        if($filters['job_type'] ?? false) {
            $query->where('job_type', request('job_type'));
        }

        if($filters['experience_level'] ?? false) {
            $query->where('experience_level', request('experience_level'));
        }

        if($filters['date_posted'] ?? false) {
            $date = request('date_posted');
            switch($date) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->where('created_at', '>=', now()->subWeek());
                    break;
                case 'month':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
                case '3months':
                    $query->where('created_at', '>=', now()->subMonths(3));
                    break;
            }
        }
    }

    /**
     * Relationship to User
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check if applications are still open
     */
    public function isApplicationOpen() {
        if (!$this->application_deadline) {
            return true; // No deadline set, always open
        }
        return now()->toDateString() <= $this->application_deadline;
    }

    /**
     * Get formatted application deadline
     */
    public function getFormattedDeadline() {
        if (!$this->application_deadline) {
            return 'No deadline set';
        }
        return $this->application_deadline->format('M d, Y');
    }

    /**
     * Get days until deadline
     */
    public function getDaysUntilDeadline() {
        if (!$this->application_deadline) {
            return null;
        }
        return now()->diffInDays($this->application_deadline, false);
    }
} 