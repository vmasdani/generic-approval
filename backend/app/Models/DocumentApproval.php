<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\DocumentApproval
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $uuid
 * @property int|null $ordering
 * @property int|null $hidden
 * @property int|null $approval_config_id
 * @property int|null $approval_timestamp
 * @property int|null $approval_needed_user_id
 * @property int|null $approval_actual_signed_user_id
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereApprovalActualSignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereApprovalConfigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereApprovalNeededUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereApprovalTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereUuid($value)
 * @property int|null $included
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereIncluded($value)
 * @property int|null $document_id
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentApproval whereDocumentId($value)
 * @mixin \Eloquent
 */
class DocumentApproval extends Model
{
    protected $fillable = [
        // 'name',
        'id',
        'hidden',
        'ordering',
        'uuid',

        'approval_config_id',
        'approval_timestamp',
        'approval_needed_user_id',
        'approval_actual_signed_user_id',
        'included',
        'document_id'
    ];

    public function approvalConfig()
    {
        return $this->belongsTo(ApprovalConfig::class, 'document_creator_id');
    }

    public function approvalNeededUser()
    {
        return $this->belongsTo(User::class, 'approval_needed_user_id');
    }

    public function approvalActualSignedUserId()
    {
        return $this->belongsTo(User::class, 'approval_actual_signed_user_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
