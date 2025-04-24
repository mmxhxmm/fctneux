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

    // Api Transform
    function comunidadToString($value) {
        $key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
        $url = "https://apiv1.geoapi.es/comunidades?type=JSON&key=$key";
        
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        foreach ($data['data'] as $comunidad) {
            if ($comunidad['CCOM'] == $value) {
              return ucwords(mb_strtolower($comunidad['COM']));
            }
        }

        return $value;
    }

    function provinciaToString($value) {
        $key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
        $url = "https://apiv1.geoapi.es/provincias?type=JSON&key=$key&sandbox=0";
    
        $response = @file_get_contents($url); // Added @ to suppress warnings
        if ($response === false) {
            return $value; // fallback if request fails
        }
    
        $data = json_decode($response, true);
    
        if (!isset($data['data'])) {
            return $value; // handle unexpected structure
        }
    
        foreach ($data['data'] as $provincia) {
            if ($provincia['CPRO'] == $value) {
                return ucwords(mb_strtolower($provincia['PRO']));
            }
        }
    
        return $value;
    }
    

    public function colaboracionToString($value) {
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

    public function gestionesToString($value) {
        switch ($value) {
            case 'primer_contacto':
                return 'Primer contacto';
            case 'pendente_respuesta':
                return 'Pendente respuesta';
            case 'volver_contactar':
                return 'Volver a contactar';
            case 'no_acogen_alumnado':
                return 'No acogen alumnado';
            case 'pendiente_firma_convenio':
                return 'Pendiente firma Convenio';
            case 'plazas_conseguidas':
                return 'Plazas conseguidas';
            case 'solicitud_plazas':
                return 'Solicitud plazas';
            default:
                return $value;
        }
    }

    public function convenioMarcoToString($value) {
        switch ($value) {
            case 'ceac':
                return 'Convenio Marco CEAC';
            case 'qbid':
                return 'Convenio Marco qbid';
            default:
                return $value;
        }
    }

    public function usoLogosToString($value) {
        switch ($value) {
            case 'si':
                return 'Si';
            case 'no':
                return 'No';
            case 'autorizacion':
                return 'Autorización previa';
            default:
                return $value;
        }
    }

    public function cicloFormativoToString($value) {
        switch ($value) {
            case 'daw':
                return 'Desarrollo de Aplicaciones Web';
            case 'asix':
                return 'Administración de Sistemas Informáticos';
            case 'dam':
                return 'Desarrollo de Aplicaciones Multiplataforma';
            case 'marketing':
                return 'Marketing Digital';
            default:
                return $value;
        }
    }

    // public function getOfertaLaboralAttribute($value) {
    //     return ucwords(strtolower($value));
    // }

    // public function getFamiliaPersonalAttribute($value) {
    //     switch ($value) {
    //         case 'sanidad':
    //             return 'Sanidad';
    //         case 'informatica':
    //             return 'Informática';
    //         case 'hosteleria':
    //             return 'Hostelería';
    //         case 'marketing':
    //             return 'Marketing';
    //         default:
    //             return $value;
    //     }
    // }

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
