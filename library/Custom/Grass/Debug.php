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
     * 
     * @param String $sSql String com a consulta.
     * @param Boolean $exit False para continuar a execução do script, 
     * true para interromper.
     */
    static public function debugSql($sSql, $exit = false){
        if(isset($sSql)){
            echo '<pre>';print_r($sSql->__toString()); $exit ? exit : '' ;
        }
    }
    /**
     * Debug para Valores
     * 
     * @param String $string String para debug.
     * @param Boolean $exit False para continuar a execução do script, 
     * true para interromper.
     */
    static public function debugValue($string, $exit = false){
        if(isset($string)){
            echo '<pre>';print_r($string); $exit ? exit : '' ;
        }
    }
}
