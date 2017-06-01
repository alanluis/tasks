<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
	protected $fillable = [
        'name',
        'description',
        'initial_date',
        'final_date',
        'status_id',
        'active'
    ];

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'initial_date',
        'final_date'
    ];

    protected $rules = [
    	'name' => 'required|max:255',
        'description' => 'required|max:600',
        'initial_date' => 'required|date_format:d/m/Y',
        'final_date' => 'required_if:status_id,4',
        'status_id' => 'required'
    ];

    private $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = \Validator::make($data, $this->rules);
        
        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }


    public function status()
    {
        return $this->belongsTo('App\Status');
    }

	public function setInitialDateAttribute($value)
    {
        $this->attributes['initial_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function setFinalDateAttribute($value)
    {
        $this->attributes['final_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

}
