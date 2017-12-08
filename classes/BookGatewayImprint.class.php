<?php
class BookGatewayImprint extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, Books.SubcategoryID, SubcategoryName, Books.ImprintID, Imprint, ProductionStatusID, BindingTypeID, TrimSize, PageCountsEditorialEst, LatestInStockDate, Description, CoverImage FROM Books JOIN Imprints USING(ImprintID) JOIN Subcategories USING(SubcategoryID)";
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getTableID() {
        return "Books.ImprintID";
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
    }
    */
}
?>