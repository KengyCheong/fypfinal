<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersInfo extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const NATIONALITY_SELECT = [
        '0' => 'Malaysian',
        '1' => 'Non-Malaysian',
    ];

    public $table = 'users_infos';

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'nric_no',
        'birth_date',
        'phone_no',
        'illness_history_id',
        'address',
        'nationality',
        'vaccine_status_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function illness_history()
    {
        return $this->belongsTo(IllnessTag::class, 'illness_history_id');
    }

    public function vaccine_status()
    {
        return $this->belongsTo(VaccineTag::class, 'vaccine_status_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
