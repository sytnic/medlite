<?php

class Doctimes extends DatabaseObject {
    use Docnames;

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

    /**
     * 
     * 
     */
    public function status_str() {
        $str = "";
        if ($this->status == 0) {
            $str = "Free"; 
        } elseif ($this->status == 1) {
            $str = "Busy";
        }

        return $str;
    }

    /**
     * 
     * @param int $clientreqs_id
     * @return string|null
     */
    public function clientreq_link() {
        if (empty($this->clientreqs_id)) {
            return null;
        } else {
            // $mystr = '<div class="w3-center">';
            $mystr = '<a href="client_editreqs.php?id=';
            $mystr.= $this->clientreqs_id;
            $mystr.= '" class="">';
            $mystr.= $this->clientreqs_id;
            $mystr.= '</a>';
            // $mystr.= '</div>';
            return $mystr;
        }
    }

}



?>