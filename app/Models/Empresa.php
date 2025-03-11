<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresas';

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
        'cif',
        'nombre',
        'colaboracion',
        'gestiones',
        'modalidad',
        'oferta_laboral',
        'entidad',
        'direccion',
        'codigoPostal',
        'municipio',
        'ubicacion',
        'familiaPersonal',
        'observaciones',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'codigoPostal' => 'integer', // Cast codigoPostal to integer
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        // Add any fields you want to hide (e.g., sensitive data)
    ];

    /**
     * Default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'colaboracion' => null,
        'gestiones' => null,
        'modalidad' => null,
        'oferta_laboral' => null,
        'entidad' => null,
        'ubicacion' => null,
        'municipio' => null,
        'direccion' => null,
        'codigoPostal' => null,
        'familiaPersonal' => null,
        'observaciones' => null,
    ];

    /**
     * Mutator for codigoPostal to ensure it is always 5 digits long.
     *
     * @param mixed $value
     */
    // public function setCodigoPostalAttribute($value)
    // {
    //     if ($value === null || strlen((string)$value) !== 5) {
    //         throw new \InvalidArgumentException('El código postal debe tener exactamente 5 dígitos.');
    //     }
    //     $this->attributes['codigoPostal'] = $value;
    // }

    /**
     * Accessor for codigoPostal to ensure it is always returned as a 5-digit string.
     *
     * @param mixed $value
     * @return string|null
     */
    // public function getCodigoPostalAttribute($value)
    // {
    //     if ($value === null) {
    //         return null;
    //     }
    //     return str_pad($value, 5, '0', STR_PAD_LEFT); // Ensure 5 digits with leading zeros
    // }

    /**
     * Define the relationship with ResponsableConvenio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsablesConvenio()
    {
        return $this->hasOne(ResponsableConvenio::class, 'empresa_cif', 'cif');
    }
}
