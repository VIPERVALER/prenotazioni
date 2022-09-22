<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    //protected $primaryKey = 'id';

    //public $incrementing = true;

    //public $timestamps = true;

    protected $fillable = [
        'id',
        'date',
        'when',
        'team',
        'machine',
        'work',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model = Reservations) {
            $model->team = Auth::user()->currentTeam->id;
        });
        self::deleting(function ($model = Reservations) {
            $model->team = Auth::user()->currentTeam->id;
        });
        static::addGlobalScope(function (Builder $builder) {
            $builder->whereTeam(Auth::user()->currentTeam->id);
            $builder->orderBy('date', 'DESC');
            $builder->orderBy('when', 'DESC');
        });
    }

    public static function deleteReserve($machine, $date)
    {
        Machines::whereId($machine)->update(['revisione' => $date]);
    }
}
