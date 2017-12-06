<?php
class CountryGateway extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT CountryCode, CountryName, Capital, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours FROM Countries";
    }
    
    protected function getPrimaryKeyName() {
        return "CountryCode";
    }
    
    protected function getTableID() {
        return "CountryName";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return null;
    }
    /*
    protected function jsonSerialize() {
        return "{'ID':\"CountryCode\", 'Name':\"CountryName\"}";
    }*/
}
?>