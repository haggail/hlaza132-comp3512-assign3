<?php
class TopCountriesWebService extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT VisitID, BookID, DateViewed, IpAddress, CountryCode, COUNT(CountryCode) as Count FROM BookVisits GROUP BY CountryCode ORDER BY Count DESC LIMIT 15";
    }
    
    protected function getPrimaryKeyName() {
        return "MessageID";
    }
    
    protected function getTableID(){
        return "EmployeeID";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    protected function addToWhere(){
        return null;
    }
}
?>