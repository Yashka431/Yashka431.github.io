<?php
class DB {

        protected static $_instance;  //экземпляр объекта
  
        public static function getInstance() { // получить экземпляр данного класса 
            if (self::$_instance === null) { // если экземпляр данного класса  не создан
                self::$_instance = new self;  // создаем экземпляр данного класса 
            } 
            return self::$_instance; // возвращаем экземпляр данного класса
        }
   
        private  function __construct() { // конструктор отрабатывает один раз при вызове DB::getInstance();
                //подключаемся к хосту
                $this->connect = mysql_connect(HOST, USER, PASSWORD) or die("Невозможно установить соединение".mysql_error());
                // выбираем базу  
                mysql_select_db(NAME_BD, $this->connect) or die ("Невозможно выбрать указанную базу".mysql_error());

        
        }
 
        private function __clone() { //запрещаем слонирование объекта модификатором private
        }
        
        private function __wakeup() {//запрещаем слонирование объекта модификатором private
        }
   
        public static function query($sql) {
        
		if(($num_args = func_num_args()) > 1){
		$arg  = func_get_args();
		unset($arg[0]);
		//Выводит значения массива args, отформатированные в соответствии с аргументом format, 
		
		
		foreach($arg as $argument=>$value){
			$arg[$argument]=mysql_real_escape_string($value); // экранируем кавычки для всех входных параметров
		}

		$sql = vsprintf($sql,$arg);	

		}
	
            $obj=self::$_instance;
        
            if(isset($obj->connect)){ 
                $obj->count_sql++;
                $start_time_sql = microtime(true);
			
              
                $result=mysql_query($sql)or die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> ".mysql_error());
                $time_sql = microtime(true) - $start_time_sql;
              //    echo "<br/><br/><span style='color:blue'> <span style='color:green'># Запрос номер ".$obj->count_sql.": </span>".$sql."</span> <span style='color:green'>(".round($time_sql,4)." msec )</span>";             
               
                return $result;
            }
            return false;
        }   
    
public function build_part_query($array,$_devide = ',',$table='')
	{
		$part_query="";
		if(is_array($array)){
			$part_query = '';
			foreach($array as $index=>$value){
				$part_query .= sprintf(" $table`%s` = '%s'".$_devide,$index,mysql_real_escape_string($value));
			}
			$part_query = trim($part_query,$_devide);
			
		}
		return $part_query;
	}


	
public function build_query($query,$array,$_devide = ',')
	{
		if(is_array($array)){
			$part_query = '';
			foreach($array as $index=>$value){
				$part_query .= sprintf(" `%s` = '%s'".$_devide,$index,mysql_real_escape_string($value));
			}
			$part_query = trim($part_query,$_devide);
			$query.=$part_query;
			return self::query($query);
		}
		return false;
	}

        //возвращает запись в виде объекта
        public function fetch_object($object)
        {
            return @mysql_fetch_object($object);
        }

        //возвращает запись в виде массива
        public function fetch_array($object)
        {
            return @mysql_fetch_array($object);
        }
        
		
		 public function num_rows($object)
        {
            return @mysql_num_rows($object);
        }
		 public function fetch_assoc($object)
        {
            return @mysql_fetch_assoc($object);
        }
		
        //mysql_insert_id() возвращает ID, 
        //сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT к серверу
        public function insert_id()
        {
            return @mysql_insert_id();
        }
        
    
}