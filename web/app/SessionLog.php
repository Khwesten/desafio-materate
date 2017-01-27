<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by IntelliJ IDEA.
 * User: k-heiner@hotmail.com
 * Date: 27/01/2017
 * Time: 15:09
 */
class SessionLog extends Model
{
    protected $table = 'session_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loginDate', 'logoutDate'
    ];
}