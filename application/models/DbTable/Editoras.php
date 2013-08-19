<?php
/**
 * Persistencia Editoras
 */
class Application_Model_DbTable_Editoras extends Zend_Db_Table_Abstract {

    protected $_name = 'bl_editoras';
    /*
     * Listar por código
     */
    public function getEditoras($numgEditora) {
        $numgEditora = (int) $numgEditora;
        $row = $this->fetchRow('numg_editora = ' . $numgEditora);
        if (!$row) {
            throw new Exception("Não foi possível localizar o código: $numgEditora");
        }
        return $row->toArray();
    }
    /**
     * Recuperar todas as Editoras Cadastradas
     */
    public function getAllEditoras() {
        $row = $this->fetchRow();
        if (!$row) {
            return false;
        }else{
            return true;
        }
    }
    /*
     * Cadastrar
     */
    public function cadastrarEditora($descNome, $descEndereco, $descObservacao) {
        $data = array(
            'desc_nome' => $descNome,
            'desc_endereco' => $descEndereco,
            'desc_observacoes' => $descObservacao,
        );
        $this->insert($data);
    }
    /*
     * Editar
     */
    public function editarEditora($numg_editora, $descNome, $descEndereco, $descObservacao) {
        $data = array(
            'desc_nome' => $descNome,
            'desc_endereco' => $descEndereco,
            'desc_observacoes' => $descObservacao,
        );
        $this->update($data, 'numg_editora = ' . (int) $numg_editora);
    }
    /*
     * Deletar
     */
    public function deletarEditora($numg_editora) {
        $this->delete('numg_editora =' . (int) $numg_editora);
    }
}

