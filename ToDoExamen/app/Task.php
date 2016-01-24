<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//We do not have to explicitly tell the Eloquent model which table it corresponds to
// because it will assume the database table is the plural form of the model name.
// So, in this case, the Task model is assumed to correspond with the tasks database table.
class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status'];


    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
