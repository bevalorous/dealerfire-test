<?phprequire_once('protected/models/Configuration.php');/** * Class incapsulates common operations with MySQL-database. * This class realizes pattern Singltone. */class Db{    protected static $_instance = null;    private $_link;	private $_host;	private $_database;	private $_username;	private $_password;    private $_isActive = false;    private function __construct()    {        $config = new Configuration('protected/config/main.php');		        $this->_host = $config->getAttribute('host');        $this->_username = $config->getAttribute('username');        $this->_password = $config->getAttribute('password');        $this->_database = $config->getAttribute('database');        $this->open();        $this->execute('SET NAMES '.$config->getAttribute('charset'));    }    private function __desctruct()    {        $this->close();    }    private function __clone() {}    private function __wakeup() {}    public static function getInstance()    {        if (is_null(self::$_instance))        {            self::$_instance = new Db();        }        return self::$_instance;    }    protected function open()	{		if ($this->_isActive)			return;		if (false === ($this->_link = mysql_connect($this->_host, $this->_username, $this->_password)) || false === mysql_select_db($this->_database, $this->_link))		{			throw new Exception('Failed to open the DB connection: '.mysql_error());		}		$this->_isActive = true;	}	protected function close()	{		if (!$this->_isActive)			return;        if (false === mysql_close($this->_link))		{			throw new Exception('Failed to close database connection: '.mysql_error());		}		$this->_isActive = false;	}    public function execute($sql)    {        return mysql_query($sql);    }            public function insert($table, $columns)    {        $sql = "INSERT INTO `$table` (`".implode('`, `', array_keys($columns)).'`) VALUES ("'.implode('", "', $columns).'")';        return $this->execute($sql);    }    public function update($table, $columns, $condition)    {        $pairs = array();        foreach ($columns as $name => $value)        {            $pairs[] = '`'.$name.'`'.' = "'.$value.'"';        }        $sql = "UPDATE `$table` SET (".implode(', ', $pairs).")";        if (trim($condition) != '')            $sql .= " WHERE $condition";        return $this->execute($sql);    }    public function delete($table, $condition)    {        $sql = "DELETE FROM `$table`";        if (trim($condition) != '')            $sql .= " WHERE $condition";        return $this->execute($sql);    }    public function select($table, $columns = '*', $condition = '', $order = '')    {        $sql = "SELECT $columns FROM `$table`";        if ($condition != '')            $sql .= " WHERE $condition";        if ($order != '')            $sql .= " ORDER BY $order";        $result = array();        $q = mysql_query($sql);        while ($row = mysql_fetch_assoc($q))        {            $result[] = $row;        }        return $result;    }}