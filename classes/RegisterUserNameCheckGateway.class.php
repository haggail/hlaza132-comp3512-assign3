<?php
class RegisterUserNameCheckGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "Select UserName from UsersLogin";
    }
    
    protected function getPrimaryKeyName() {
        return null;
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