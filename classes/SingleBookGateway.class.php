<?php
class SinglebookGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, SubcategoryName, Imprint, ImprintID, Status, BindingType, TrimSize, PageCountsEditorialEst, Description 
                        FROM Books JOIN BindingTypes USING(BindingTypeID) JOIN Statuses JOIN Subcategories USING(SubcategoryID) JOIN Imprints USING(ImprintID) WHERE ProductionStatusID=StatusID";
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getTableID() {
        return null;
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return "ISBN10";
    }
}
?>