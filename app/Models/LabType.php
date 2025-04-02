<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LabType extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];
    public function labTest()
    {
        return $this->belongsTo(LabTest::class , 'id');
    }
    public static function filterRange($request)
    {
        if ($request->has('fromRange') && $request->has('toRange')) {
            return self::whereBetween('price', [$request->fromRange, $request->toRange])->paginate(10);
        }
        return self::paginate(10);
    }
}
