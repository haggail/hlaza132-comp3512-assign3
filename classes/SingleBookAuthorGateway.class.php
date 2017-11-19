<?php
class SingleBookAuthorGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT FirstName, LastName FROM Books"; 
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getTableID() {
        return "ISBN10";
    }
    
    protected function getJoinStatement(){
        return " JOIN BookAuthors JOIN Authors";
    }
    
    protected function addToWhere(){
        return " AND Books.BookID = BookAuthors.BookId AND BookAuthors.AuthorId = Authors.AuthorID ORDER BY BookAuthors.Order";
    }
}
?>