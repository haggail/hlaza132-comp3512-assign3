<?php
class BookVisitsGateway extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT VisitID, BookID, DateViewed, IpAddress, CountryCode FROM BookVisits";
    }
    
    protected function getPrimaryKeyName() {
        return "VisitID";
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
    /*
    protected function getJSONObj() {
        return "{}";
    }*/
}
?>