<?php
class ImprintGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT ImprintID, Imprint FROM Imprints";
    }
    
    protected function getPrimaryKeyName() {
        return "ImprintID";
    }
    
    protected function getTableID() {
        return null;
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
        protected function addToWhere(){
        return null;
    }
}
?>