<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaccineTag extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const VACCINE_STATUS_SELECT = [
        'Not Yet Implanted'  => 'Not Yet Implanted',
        '1st Dose Completed' => '1st Dose Completed',
        '2nd Dose Completed' => '2nd Dose Completed',
    ];

    public $table = 'vaccine_tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'vaccine_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function vaccineStatusUsersInfos()
    {
        return $this->hasMany(UsersInfo::class, 'vaccine_status_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
