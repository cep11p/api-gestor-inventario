<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

/**
 *
 * @author carlos
 */
interface IServicioLugar {
    //put your code here
    /**
     * Buscar la localidad por id y devuelve los datos de la localidad encontrada
     * @param int $id
     * @return boolean
     */
    public function buscarLocalidadPorId($id);
    
    public function crearLugar($data);    
    
    public function buscarLugar($param);
    
    public function buscarLocalidad($param);
    public function buscarMunicipio($param = array());
    public function buscarDelegacion($param = array());
    public function buscarComisionFomento($param = array());
    
    public function buscarLugarPorId($id);
    public function buscarDelegacionPorId($id);
    public function buscarMunicipioPorId($id);
    public function buscarComisionFomentoPorId($id);
    
    public function obtenerParametro();
    public function obtenerParametroPersonalizado($param = array());

    
    
    /**
     * crear un string con los criterio de busquedad por ejemplo: localidadid=1&calle=mata negra&altura=123
     * @param array $param
     * @return string
     */
    public function crearCriterioBusquedad($param);
    
    
    
    /**
     * 
     * @param int $nro_documento
     * @return int personaid
     */
    public static function buscarPersonaEnRegistralPorNumeroDocuemento($nro_documento);
}
