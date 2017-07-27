<?php 
require_once"config.php";
class DB{
    protected $p = null;
    public $n = 0;
    private $numRow;
    public function __construct()
    {
        $link = "mysql:host=".HOST.";dbname=".DB_NAME;
        $this->p = new PDO($link,DB_USER,DB_PASS);
        $this->p->query('set names "utf8" ');
    }
    
    public function __destruct()
    {
        $this->p= null; 
    }
    public function QueryAll($sql,$arr=array())
    {
        $stm = $this->p->prepare($sql);
        $stm->execute($arr);
        $this->n = $stm->rowCount();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function QueryRow($sql,$arr=array())
    {
        $stm = $this->p->prepare($sql);
        $stm->execute($arr);
        $this->n = $stm->rowCount();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    public function selectquery($sql,$arr=array())
    {
        return $this->QueryAll($sql,$arr);  
    }
    public function selectrow($sql,$arr=array())
    {
        return $this->QueryRow($sql,$arr);
    }
    public function getRowCount()
    {
            return $this->numRow;   
    }
        
}
?>