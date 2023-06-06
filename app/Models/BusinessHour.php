<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessHour extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_CLOSE = 0;
    public const STATUS_OPEN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day',
        'from',
        'to',
        'status',
    ];

    // TODO : Accessor and mutatuor to days

    public static $status = [0 => 'close', 1 => 'open'];


    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => (empty($value) ? self::$status[strtolower(0)] : self::$status[strtolower($value)]),
            set: fn ($value) => (empty($value) ? 1 : array_search(strtolower($value), self::$status)),
        );
    }

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function from(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new  \Illuminate\Database\Eloquent\Casts\Attribute(
            set: fn ($value) => empty($value) ? Carbon::createFromFormat('H:i', '00:00') : Carbon::createFromFormat('H:i', $value),

        );
    }

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function to(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new  \Illuminate\Database\Eloquent\Casts\Attribute(
            set: fn ($value) => empty($value) ? Carbon::createFromFormat('H:i', '00:00') : Carbon::createFromFormat('H:i', $value),
        );
    }
    protected $casts = [
        'from' => 'date:h:i',
        'to' => 'date:h:i'
    ];
}
