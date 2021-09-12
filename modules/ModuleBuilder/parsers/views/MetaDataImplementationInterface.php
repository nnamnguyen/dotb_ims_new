<?php


interface MetaDataImplementationInterface
{
    public function getViewdefs () ;
    public function getFielddefs () ;
    public function getLanguage () ;
    public function deploy ($defs) ;
    public function getHistory () ;
    public function getComboFieldDefs () ;
}
