<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $firstName
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int $role_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Campus|null $campus
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Personnel|null $personnel
 * @property-read Collection|Professor[] $teacher
 * @property-read int|null $professors_count
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Subsidiary|null $subsidiary
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read Collection|Department[] $admin
 * @property-read int|null $users_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereKey($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin Eloquent
 * @property int $status
 * @method static Builder|User whereStatus($value)
 * @property-read bool $is_admin
 * @property-read bool $is_student
 * @property-read bool $is_teacher
 * @property-read int|null $roles_count
 * @property-read Profile|null $profile
 * @property-read Collection|Professor[] $professors
 * @property-read Collection|Department[] $users
 * @property int $active_status
 * @property string $avatar
 * @property int $dark_mode
 * @property string $messenger_color
 * @property-read Setting|null $setting
 * @method static Builder|User whereActiveStatus($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereDarkMode($value)
 * @method static Builder|User whereMessengerColor($value)
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @property-read Collection|Role[] $roles
 * @property-read int|null $campus_count
 * @property-read Collection|\App\Models\Department[] $departments
 * @property-read int|null $departments_count
 * @property-read Collection|\App\Models\Group[] $group
 * @property-read int|null $group_count
 * @property-read Collection|\App\Models\Group[] $group_member
 * @property-read int|null $group_member_count
 * @property-read \App\Models\Institution|null $institution
 * @property-read Collection|\App\Models\Message[] $message
 * @property-read int|null $message_count
 * @property-read Collection|\App\Models\Guardian[] $parents
 * @property-read int|null $parents_count
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasKeyTrait, HasRoles;

    protected $guarded = [];

    public function personnel(): HasOne
    {
        return $this->hasOne(Personnel::class);
    }

    public function campus(): HasMany
    {
        return $this->hasMany(Campus::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function subsidiary(): HasOne
    {
        return $this->hasOne(Subsidiary::class);
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    public function setting(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function departments(): BelongsToMany
    {
        return $this
            ->belongsToMany(Department::class, 'user_department')
            ->withTimestamps();
    }

    public function parents(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }


    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Group', 'admin_id');
    }

    public function group_member(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\Group',
            'group_participants',
            'user_id',
            'group_id'
        )
            ->orderBy('updated_at', 'desc');
    }

    public function message(): HasMany
    {
        return $this->hasMany('App\Models\Message', 'user_id');
    }
}
