<?php
class StatesGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT StateId, StateName, StateAbbr FROM States";
    }
    
    protected function getPrimaryKeyName() {
        return "StateId";
    }
    
    protected function getTableID() {
        
    }
}
?>