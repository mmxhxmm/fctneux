<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'ofertaLaboral',
        'entidad',
        'direccion',
        'codigoPostal',
        'comunidad',
        'provincia',
        'municipio',
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

    // Accessors
    public function getColaboracionAttribute($value) {
        switch ($value) {
            case 'prospeccion':
                return 'Prospección';
            case 'colaboracion':
                return 'Colaboración';
            case 'inactiva':
                return 'Inactiva';
            default:
                return $value;
        }
    }

    public function getModalidadAttribute($value) {
        switch ($value) {
            case 'presencial':
                return 'Presencial';
            case 'remoto':
                return 'Remoto';
            case 'semipresencial':
                return 'Semipresencial';
            default:
                return $value;
        }
    }

    public function getGestionesAttribute($value) {
        switch ($this->colaboracion) {
            case 'Prospección':
                switch ($value) {
                    case 'primer_contacto':
                        return 'P - Primer contacto';
                    case 'pendente_respuesta':
                        return 'P - Pendente respuesta';
                    case 'volver_contactar':
                        return 'P - Volver a contactar';
                    case 'no_acogen_alumnado':
                        return 'P - No acogen alumnado';
                    default:
                        return $value;
                }
            case 'Colaboración':
                switch ($value) {
                    case 'pendiente_firma_convenio':
                        return 'C - Pendiente firma Convenio';
                    case 'plazas_conseguidas':
                        return 'C - Plazas conseguidas';
                    case 'solicitud_plazas':
                        return 'C - Solicitud plazas';
                    default:
                        return $value;
                }
            default:
                return $value;
        }
    }

    public function getOfertaLaboralAttribute($value) {
        return ucwords(strtolower($value));
    }

    public function getFamiliaPersonalAttribute($value) {
        switch ($value) {
            case 'sanidad':
                return 'Sanidad';
            case 'informatica':
                return 'Informática';
            case 'hosteleria':
                return 'Hostelería';
            case 'marketing':
                return 'Marketing';
            default:
                return $value;
        }
    }

    /**
     * Define the relationship with ResponsableConvenio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsablesConvenio()
    {
        return $this->HasMany(ResponsableConvenio::class, 'empresa_id', 'id');
    }

    public function centrosTrabajo()
    {
        return $this->HasMany(CentroTrabajo::class, 'empresa_id', 'id');
    }

    public function practica()
    {
        return $this->HasMany(Practica::class, 'empresa_id', 'id');
    }
}
