<?php

class Requests extends DatabaseObject {

    protected static $table_name="client_reqs";
	protected static $db_fields=array('id', 'firstname', 'midname', 
        'surname', 'datebirth', 'phone', 'doc_id', 'spec_id',
        'doctime_id', 'who_edited', 'when_edited' );
	
	public $id;
	public $firstname;
	public $midname;
	public $surname;
	public $datebirth;
    public $phone;
    public $doc_id;
    public $spec_id;
    public $doctime_id;
    public $who_edited;
    public $when_edited;







}
?>