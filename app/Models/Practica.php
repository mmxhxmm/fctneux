<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Practica extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'practicas';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'cicloFormativo',
        'cursoAcademico',
        'periodoTo',
        'periodoFrom',
        'horarioTo',
        'horarioFrom',
        'convenioMarco',
        'usoLogos',
        'observaciones',
        'numPlazasAsignadas'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'periodoFrom' => 'date',
        'periodoTo' => 'date',
        'numPlazasAsignadas' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define Relationships
    public function usuario()
    {
        return $this->belongsTo(User::class, 'tecnicoGestion', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function tutores()
    {
        return $this->HasMany(Tutor::class, 'id_practica', 'id');
    }

    public function tutoresEmpresa()
    {
        return $this->HasMany(TutorEmpresa::class, 'id_practica', 'id');
    }
}
