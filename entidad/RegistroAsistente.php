<?php

namespace entidad;

class RegistroAsistente {

    protected ?int $id;
    protected string $email;
    protected $fecha_inscripcion;
    protected string $actividad;
    
    public function __construct( array $datos ) {
        foreach( $datos as $propiedad => $valor ) {
            $this->__set($propiedad, $valor);
        }
    }

    public function __set( string $propiedad, mixed $valor ) {
        if( property_exists($this, $propiedad) )
            $this->$propiedad = $valor;
    }

    public function __get( string $propiedad ) {
        if( property_exists($this, $propiedad) )
            return $this->$propiedad;
    }

    public function __toString() {
        $str = "Clase: " . self::class . ". ";
        $propiedades = get_class_vars(get_class($this));

        foreach( $propiedades as $propiedad ) {
            $str .= "$propiedad: {$this->$propiedad}, ";
        }

        rtrim($str, ", ");
        $str .= ".";
        return $str;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "email" => $this->email,
            "fecha_inscripcion" => $this->fecha_inscripcion,
            "actividad" => $this->actividad
        ];
    }
}

?>