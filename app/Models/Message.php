<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    const Types = [
        'Sender'=>1,
        'Receiver'=>0,
    ];

    const MessageType = [
        'Text'=>1,
        'Image'=>2,
        'File'=>3,
        'Audio'=>4,
        'Video'=>5,
    ];

    protected $table = 'messages';

    protected $fillable=[
        'sender_id',
        'receiver_id',
        'message',
        'message_type',
        'type',
        'read_at'
    ];

    protected $appends=['send_at', 'send_time'];

    public function getSendAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d,M y h:i a');
    }
    public function getSendTimeAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('h:i a');
    }

}
