<?php

class Doctimes extends DatabaseObject {

    protected static $table_name="doctime";
	protected static $db_fields=[
        'id', 'doc_id', 'date', 
        'time', 'status', 'clientreqs_id' ];
	
	public $id;
	public $doc_id;
	public $date;
	public $time;
	public $status;
    public $clientreqs_id;

    public function humandate() {
        return date("d.m.y", strtotime($this->date));
    }

    public function day() {
        $day = date("l", strtotime($this->date));
        return $day; 
    }

    public function time() {
        $time = substr($this->time, 0, -3);
        return $time;
    }

}



?>