<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CentroTrabajo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'centros_trabajo';

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
        'codigoPostal',
        'comunidad',
        'provincia',
        'municipio',
        'direccion',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'codigoPostal' => 'integer',
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
        $url = "https://apiv1.geoapi.es/provincias?type=JSON&key=$key";
        
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        foreach ($data['data'] as $provincias) {
            if ($provincias['CPRO'] == $value) {
                return ucwords(mb_strtolower($provincias['PRO']));
            }
        }

        return $value;
    }

    // Define Relationships
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function personaContacto()
    {
        return $this->HasMany(PersonaContacto::class, 'id_centrosTrabajo', 'id');
    }
}