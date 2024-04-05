<?php

namespace Kurnosovmak\Parts\Parts\Infra\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 */
class Part extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'slug',
    ];

}