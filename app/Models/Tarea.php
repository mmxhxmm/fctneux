<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tarea extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tareas';

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
        'nombre',
        'asignado',
        'estado',
        'descripcion',
        'comentarios',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'estado' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Possible task states.
     *
     * @var array
     */
    public const ESTADOS = [
        'to_do' => 'Por hacer',
        'in_progress' => 'En progreso',
        'revision' => 'En revisión',
        'done' => 'Completada'
    ];
    
    /**
     * Get the human-readable status name.
     *
     * @return string
     */
    public function getEstadoNombreAttribute()
    {
        return self::ESTADOS[$this->estado] ?? $this->estado;
    }

    /**
     * Scope for tasks in a specific state.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $estado
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    // Define Relationships
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_cif', 'cif');
    }
}
