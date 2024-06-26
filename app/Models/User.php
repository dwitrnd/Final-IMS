<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'gender',
        'photo',
        'birthday',
        'contact',
        'address',
        'department_id',
        'role_id',
        'contract_status',
        'contract_start_date',
        'contract_end_date',
        'hourly_rate',
        'pan_number',
        'bank_name',
        'bank_account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // A user belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // A user belongs to a role.
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function Worklogs()
    {
        return $this->hasMany(Work_log::class);
    }

    public function latestWorklogs()
    {
        return $this->hasMany(Work_log::class)->latest();
    }

    public function MonthlyWorklogs()
    {
        $nepalidate = NepaliCalendar::AD2BS(Carbon::now()->toDateString());
        $nepaliMonth = $nepalidate["MM"];
        $nepaliYear = $nepalidate["YYYY"];
        $startdateandenddate = NepaliCalendar::bsMonthStartEndDates($nepaliMonth,  $nepaliYear);
        $firstdayofMonth = $startdateandenddate["start_date_of_month"];
        $lastdayofMonth = $startdateandenddate["end_date_of_month"];
        $firstdayofMonthinAD = NepaliCalendar::BS2AD($firstdayofMonth)["AD_DATE"];
        $lastdayofMonthinAD = NepaliCalendar::BS2AD($lastdayofMonth)["AD_DATE"];


        return $this->hasMany(Work_log::class)->latest()->whereDate('created_at', '>=', $firstdayofMonthinAD)->whereDate('created_at', '<=', $lastdayofMonthinAD);
    }
    public function ManualWorklog($startDate, $endDate)
    {
        return $this->hasMany(Work_log::class)->latest()->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
    }
    public function Leaves()
    {
        return $this->hasMany(Leaves::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function MonthlyLeaves()
    {
        $nepalidate = NepaliCalendar::AD2BS(Carbon::now()->toDateString());
        $nepaliMonth = $nepalidate["MM"];
        $nepaliYear = $nepalidate["YYYY"];
        $startdateandenddate = NepaliCalendar::bsMonthStartEndDates($nepaliMonth,  $nepaliYear);
        $firstdayofMonth = $startdateandenddate["start_date_of_month"];
        $lastdayofMonth = $startdateandenddate["end_date_of_month"];
        $firstdayofMonthinAD = NepaliCalendar::BS2AD($firstdayofMonth)["AD_DATE"];
        $lastdayofMonthinAD = NepaliCalendar::BS2AD($lastdayofMonth)["AD_DATE"];

        return $this->hasMany(Leaves::class)->latest()->whereDate('created_at', '>=', $firstdayofMonthinAD)->whereDate('created_at', '<=', $lastdayofMonthinAD);
    }
}
