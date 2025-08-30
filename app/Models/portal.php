<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $table = "portals";
    protected $fillable = [
        "UniversityName",
        "ProgramName",
        "Description",
        "ApplicationDeadline",
        "Status",
        "Link",
    ];

    public function applications()
    {
    return $this->hasMany(Application::class);
    }

}
