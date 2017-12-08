<?php
class BookVisitsGateway2 extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT VisitID, BookID, DateViewed, IpAddress, CountryCode, COUNT(VisitID) as Visits FROM BookVisits WHERE DateViewed LIKE '06/__/2017' GROUP BY CountryCode";
        //SELECT VisitID, BookID, DateViewed, IpAddress, CountryCode, count(CountryCode) as Countries FROM BookVisits
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