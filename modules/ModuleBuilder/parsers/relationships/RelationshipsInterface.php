<?php


interface RelationshipsInterface
{

    static public function findRelatableModules () ;
    
    public function load () ;

//  public function build () ;
    
    public function getRelationshipList ();
    
    public function get ($relationshipName) ;

    public function add ($relationship) ;

//    public function delete ($relationshipName) ;
    
}