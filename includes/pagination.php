<?php

class Pagination {

    public $current_page;
    public $per_page;
    public $total_count;
  
    public function __construct($page=1, $per_page=20, $total_count=0){
        $this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;
    }
    
    public function offset() {
        // Assuming 20 items per page:
        // page 1 has an offset of 0    (1-1) * 20
        // page 2 has an offset of 20   (2-1) * 20
        //   in other words, page 2 starts with item 21
        return ($this->current_page - 1) * $this->per_page;
    }

    /**
     * сколько всего страниц понадобится для пагинации
     * 
     * @return int 
     */    
    public function total_pages() {
        // ceil(104/20)
        return ceil($this->total_count/$this->per_page);
    }

    public function previous_page() {
        return $this->current_page - 1;
    }
      
    public function next_page() {
        return $this->current_page + 1;
    }
    
    
    /**
     * вычисляет, есть ли предыдущая страница для пагинации   
     * 
     */
    public function has_previous_page() {
        // если предыдущая страница (число) больше или равна 1, то
        // предыдущая страница есть, иначе
        // (если предыдущая страница, вычисленное число) равно 0 или меньше,
        // то возвращается ложь 
        return $this->previous_page() >= 1 ? true : false;
    }

    
    /**
     * вычисляет, есть ли следующая страница для пагинации 
     * 
     */  
    public function has_next_page() {
        // если следующая страница (число) оказывается больше, чем (число) общее количество страниц,
        // то возвращается ложь, иначе истина
        return $this->next_page() <= $this->total_pages() ? true : false;
    }
}
?>