<?php
class BookVisitsGateway extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT CountryName, CountryCode, COUNT(*) AS Count FROM BookVisits JOIN Countries USING(CountryCode) GROUP BY CountryCode ORDER BY Count DESC LIMIT 15";
    }
    
    protected function getPrimaryKeyName() {
        return "CountryCode";
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