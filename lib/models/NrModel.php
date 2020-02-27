<?php
class NrModel {
	public $tableName;
	public $ignore = '';
	public $prefix = '';
	/**
	 * @var wpdb 
	 */
	protected $wpdb;
	protected function __construct($inTableName) {
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->prefix = $this->wpdb->prefix;
		$this->tableName = $this->wpdb->prefix . $inTableName;
	}
	
	/**
	 * 初期化する.コンストラクタを宣言するとアクセス修飾子を付与出来ないので宣言しない
	 */
	final protected function init($inTableName){
		$this->tableName = $this->wpdb->prefix . $inTableName;
	}


//	public function isField($filedName){
//		return $this->wpdb->query("SHOW FIELDS FROM {$this->tableName};");
//
//	}
//	public function isTableExists($inTableName){
//		$q = "SHOW TABLE STATUS LIKE '%" . $inTableName . "%'";
//		$stmt = $this->pdo->prepare($q);
//		$stmt->execute();
//		$row = $stmt->fetch(PDO::FETCH_ASSOC);
//		return $row !== false;
//	}
	public function insert($inArray){
		$keys = '';
		$value = '';
		$valueArray = array();

		foreach($inArray as $key => $value){
			$keys .= $key . ',';
			if(is_numeric($value)){
				$values .= '%d,';
			}else{
				$values .= '%s,';
			}
			$valueArray[] = $value;
		}
		$keys = rtrim($keys, ',');
		$values = rtrim($values, ',');
		$sql = 'insert into ' . $this->tableName . '
                   (' . $keys . ')
            values (' . $values . ')
           ';
//		echo "sql:$sql\n";
//		return $this->wpdb->query($sql);
		return $this->wpdb->query( $this->wpdb->prepare($sql, $valueArray) );
	}
	/**
	 * 汎用update
	 * @param array $inUpdateArray updateしたいフィールド名を連想配列で渡す。例：array('name' => 'taro', 'email' => 'hoge@com.com')
	 * @param array $inTargetArray update対象としたいフィールド名を連想配列で渡す。複数の場合は間にorかandを入れる。例 array('id' => 10 , 'and', 'title' => 'kikikaikai')
	 * @return boolean 成功/可否
	 */
	public function update($inUpdateArray, $inTargetArray){
		//■update対象となっているフィールドの処理
		$value = '';
		$valueArray = array();
		foreach($inUpdateArray as $key => $value){
			if(is_numeric($value)){
				$values .= $key . ' = %d,';
			}else{
				$values .= $key . ' = %s,';
			}
			$valueArray[] = $value;
		}
		$values = rtrim($values, ',');

		//■WHERE 以降の処理
		$whereAfter = '';
		$valueArray2 = array();
		foreach($inTargetArray as $key => $value){
			if(is_array($value) && count($value) === 3){
					$whereAfter .= $k1 . ' = %d';
					$valueArray[] = $v1;
			}
			else if(is_array($value)){
				foreach($value as $k1 => $v1){
					if(is_numeric($v1)){
						$whereAfter .= $k1 . ' = %d';
					}else{
						$whereAfter .= $k1 . ' = %s';
					}
					$valueArray[] = $v1;
					//何があっても一回しかループしない
					break;
				}
			}
			else if(strtolower($value) == 'and' && is_int($key)){
				$whereAfter .= ' AND ';
			}else if(strtolower($value) == 'or' && is_int($key)){
				$whereAfter .= ' OR ';
			}
			else{
				if(is_numeric($value)){
					$whereAfter .= $key . ' = %d';
				}else{
					$whereAfter .= $key . ' = %s';
				}
				$valueArray2[] = $value;
			}
		}

		$sql = "update {$this->tableName} set $values WHERE " . $whereAfter;
		return $this->wpdb->query( $this->wpdb->prepare($sql, array_merge($valueArray, $valueArray2)) );
	}
//	public function get_all($inAfterQuery=''){
//		$q = "SELECT * from {$this->tableName} WHERE 1=1 " . $inAfterQuery;
//		$stmt = $this->pdo->prepare($q);
//		try{
//			$stmt->execute();
//			$ret = array();
//			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//				$ret[] = $row;
//			}
//			return $ret;
//		}catch(PDOException $e){
//			echo $e->getMessage();
//			exit;
//		}
//	}
	public function gets($inTargetArray, $inAfterQuery='', $results=true){
	//■WHERE 以降の処理
		$whereAfter = '';
		$valueArray = array();
		foreach($inTargetArray as $key => $value){
			if(is_array($value) && count($value) === 3){
					if(is_numeric($value[2])){
						$whereAfter .= $value[0] . ' ' . $value[1] . ' ' . '%d';
					}else{
						$whereAfter .= $value[0] . ' ' . $value[1] . ' ' . '%s';
					}
					$valueArray[] = $value[2];
			}
			else if(is_array($value)){
				foreach($value as $k1 => $v1){
					if(is_numeric($v1)){
						$whereAfter .= $k1 . ' = %d';
					}else{
						$whereAfter .= $k1 . ' = %s';
					}
					$valueArray[] = $v1;
					//何があっても一回しかループしない(入力値の特性上)
					break;
				}
			}
			else if(strtolower($value) == 'and' && is_int($key)){
				$whereAfter .= ' AND ';
			}
			else if(strtolower($value) == 'or' && is_int($key)){
				$whereAfter .= ' OR ';
			}
			else{
				if(is_numeric($value)){
					$whereAfter .= $key . ' = %d';
					$valueArray[] = $value;
				}else{
					$whereAfter .= $key . ' = %s';
					$valueArray[] = $value;
				}
			}
		}
		if(!$inAfterQuery)$inAfterQuery = ' ' . $inAfterQuery;
		if($whereAfter === ''){
			$whereAfter = 1;
		}
		$sql = "SELECT * from {$this->tableName} WHERE " . $whereAfter . $inAfterQuery;
		if($results){
			return $this->wpdb->get_results($this->wpdb->prepare($sql, $valueArray));
		}
		else{
			return $this->wpdb->get_row($this->wpdb->prepare($sql, $valueArray));
		}
	}
	public function get($inTargetArray, $inAfterQuery=''){
		return $this->gets($inTargetArray, $inAfterQuery, false);
	}
//	public function getBindParam($inValue){
//		switch(true){
//			case is_bool($inValue) :
//				return PDO::PARAM_BOOL;
//			case is_null($inValue) :
//				return PDO::PARAM_NULL;
//			case is_int($inValue) :
//				return PDO::PARAM_INT;
//			case is_float($inValue) :
//			case is_numeric($inValue) :
//			case is_string($inValue) :
//			default:
//				return PDO::PARAM_STR;
//		}
//	}
//	public function errorInfo(){
//		return var_export(ReafDB::getPDO()->errorInfo(), true);
//	}
//	public function lock(){
//		$this->pdo->query("LOCK TABLES {$this->tableName} READ;");
//	}
//	public function unlock(){
//		$this->pdo->query('UNLOCK TABLES;');
//	}
//	final public function __clone(){
//		throw new Exception("you can't clone this object");
//	}
//	public function setIgnore(){
//		$this->ignore = ' ignore ';
//	}
//	public function unsetIgnore(){
//		$this->ignore = '';
//	}
	public function delete($param, $value) {
		$sql = "delete from {$this->tableName} WHERE {$param} = %d";
		return $this->wpdb->query( $this->wpdb->prepare($sql, array($value)) );		
	}
	public function is($param, $value){
		$tmp = $this->get(array($param => $value));
		return $tmp !== false;
	}
}

