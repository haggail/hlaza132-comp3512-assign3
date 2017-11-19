<?php
class BookGatewaySubcat extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, Books.SubcategoryID, SubcategoryName, Books.ImprintID, Imprint, ProductionStatusID, BindingTypeID, TrimSize, PageCountsEditorialEst, LatestInStockDate, Description, CoverImage FROM Books JOIN Imprints USING(ImprintID) JOIN Subcategories USING(SubcategoryID)";
    }
    
    protected function getPrimaryKeyName() {
        return "Books.SubCategoryID";
    }
    
    protected function getTableID() {
        return "Books.SubcategoryID";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return "Books.ImprintID";
    }
}
?>