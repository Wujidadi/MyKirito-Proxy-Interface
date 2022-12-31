<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 玩家令牌
 *
 * @property int $id
 * @property string $player_name 玩家暱稱
 * @property string $player_id Token第1段，玩家ID
 * @property string $section_2 Token第2段，固定值
 * @property string $section_3 Token第3段，變動值
 * @property Carbon $created_at 資料建立時間
 * @property Carbon $updated_at 最後更新時間
 */
class PlayerTokens extends Model
{
    use HasFactory;

    protected $table = 'player_tokens';
    protected $fillable = ['player_name', 'player_id', 'section_2', 'section_3'];
    protected $hidden = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s.u',
        'updated_at' => 'datetime:Y-m-d H:i:s.u',
    ];
}
