<?php

class Requests extends DatabaseObject {
    use Docnames;

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

    public function fullname() {
        return $this->firstname . " " . $this->surname;
    }

    public function humandate() {
        return date("d.m.y", strtotime($this->datebirth));
    }

    public function get_specname() {
        return get_specname_by_specid($this->spec_id);
    }

    public function doc_fullname() {
        $docrow = get_doc_by_id($this->doc_id);
        return $docrow['firstname']." ".$docrow['surname']; 
    }

    /**
     * 
     * @return string $date_raw
     */
    private function raw_doctime_date() {
        $doctimerow = get_doctimerow_by_doctimeid($this->doctime_id);
        $date_raw =  $doctimerow["date"];
        return $date_raw;
    }

    public function date_meet() {
        $date_raw = self::raw_doctime_date();
        $datemeet = date("d.m.y", strtotime($date_raw));
        return $datemeet;
    }

    public function day_meet() {
        $date_raw = $this->raw_doctime_date();
        $daymeet = date("l", strtotime($date_raw));
        return $daymeet; 
    }

    public function time_meet() {
        $doctimerow = get_doctimerow_by_doctimeid($this->doctime_id);
        $time_raw = $doctimerow["time"];
        $timemeet = substr($time_raw, 0, -3);
        return $timemeet; 
    }





}
?>