<?php
    namespace PRJM011;

    class PagePerson extends Page
    {
        public function __construct($opts = array(), $tpl_dir = "/views/persons/")
        {
            parent::__construct($opts, $tpl_dir);
        }
    }
?>
