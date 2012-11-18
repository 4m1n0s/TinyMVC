<?php
# Created By iAm[i]nE.
# www.iamine.com

class index extends ModelBase {

    function getList() {
        return  $this->provider->fetchResultSet(
            'SELECT * from db_table' //Query Test
        );
    }

}