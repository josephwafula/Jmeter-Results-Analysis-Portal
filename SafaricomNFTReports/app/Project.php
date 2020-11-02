<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class Project
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name', 'expected_TPS', 'error_rate', 'AVG_response_time', 'CPU_utilization', 'RAM_utilization', 'status', 'createdby',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = [
      //  'password', 'remember_token',
    //];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
      //  'email_verified_at' => 'datetime',
    //];
}
