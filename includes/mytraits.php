<?php
trait Docnames {

    public function doc_fullname() {
        $docrow = get_doc_by_id($this->doc_id);
        return $docrow['firstname']." ".$docrow['surname']; 
    }

}

?>