<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $uuid
 * @property int|null $ordering
 * @property int|null $hidden
 * @property int|null $document_creator_id
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocuments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUuid($value)
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereName($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
    protected $fillable = [
        // 'name',
        'id',
        'hidden',
        'ordering',
        'uuid',
        
        'name',
        'document_creator_id',
    ];

}
