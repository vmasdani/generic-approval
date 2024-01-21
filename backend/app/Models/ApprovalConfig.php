<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\ApprovalConfig
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig query()
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $uuid
 * @property int|null $ordering
 * @property int|null $hidden
 * @property string|null $position
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalConfig whereUuid($value)
 * @mixin \Eloquent
 */
class ApprovalConfig extends Model
{
    protected $fillable = [
        // 'name',
        'id',
        'hidden',
        'ordering',
        'uuid',
        
        'user_id',
        'position',
    ];

}
