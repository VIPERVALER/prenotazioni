<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Machines extends Model
{
    use HasFactory;

    protected $table = 'machines';

    //protected $primaryKey = 'id';

    //public $incrementing = true;

    //public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'revisione',
        'team',
        'photo',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /*protected $attributes = [
        'team' => 'Auth::user()->currentTeam->id',
    ];*/

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model = Machines) {
            $model->team = Auth::user()->currentTeam->id;
		});
        static::addGlobalScope(function (Builder $builder) {
            $builder->whereTeam(Auth::user()->currentTeam->id);
            $builder->orderBy('name');
        });
    }

    public static function updateReview($machine, $date)
    {
        Machines::where('id',$machine)->update(['revisione' => $date]);
    }

    public static function deleteMachine($id)
    {
        Machines::where('id',$id)->delete();
    }

    /*
    public static function loadMachine()
    {
        //Machines::where([['id',$id],['team',Auth::user()->currentTeam->id]])->delete();
        //return Machines::where('team',Auth::user()->currentTeam->id)->get();
        return Machines::all();
    }
    */
}
