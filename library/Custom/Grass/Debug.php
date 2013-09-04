<?php
/**
 *
 * Descrição:Classe Debug
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 04-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Custom_Grass_Debug {
    /**
     * Debug para consultas 
     */
    static public function debugSql($sql, $exit = false){
        if(isset($sql)){
            echo '<pre>';print_r($sql->__toString()); $exit ? exit : '' ;
        }
    }
    /**
     * Debug para Valores
     */
    static public function debugValue($value, $exit = false){
        if(isset($value)){
            echo '<pre>';print_r($value); $exit ? exit : '' ;
        }
    }
}
