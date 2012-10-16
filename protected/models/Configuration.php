<?php
require_once('base/Model.php');
class Configuration extends Model
{
	private $_configFile;

	public function __construct($configFile)
	{
		parent::__construct();
		$this->_configFile = $configFile;
		if (file_exists($configFile))
		{
			$configArray = include($configFile);
			foreach ($this->attributeNames() as $name)
			{
				if (isset($configArray[$name]))
					$this->setAttribute($name, $configArray[$name]);
			}
		}
	}

	public function attributeNames()
    {
        return array(
            'host',
            'username',
            'password',
			'passwordConfirmation',
            'database',
			'charset',
        );
    }

	public function validate()
	{
		$this->_errors = array();

        $host = trim($this->getAttribute('host'));
        if (empty($host))
            $this->addError('host', tr('Configuration', "Field 'Host' is required"));
        elseif (strlen($host)>100)
            $this->addError('host', tr('Configuration', "Field 'Host' is too long (max = 100)"));

		$username = trim($this->getAttribute('username'));
		if (empty($username))
            $this->addError('username', tr('Configuration', "Field 'Username' is required"));
        elseif (strlen($username)>100)
            $this->addError('username', tr('Configuration', "Field 'Username' is too long (max = 100)"));

		$password = trim($this->getAttribute('password'));
		$passwordConfirmation = trim($this->getAttribute('passwordConfirmation'));
		if ($password != $passwordConfirmation)
			$this->addError('passwordConfirmation', tr('Configuration', "Passwords don\'t match"));

		$database = trim($this->getAttribute('database'));
		if (empty($database))
            $this->addError('database', tr('Configuration', "Field 'Database' is required"));
		elseif (strlen($database)>100)
            $this->addError('database', tr('Configuration', "Field 'Database' is too long (max = 100)"));

		$charset = trim($this->getAttribute('charset'));
		if (empty($charset))
            $this->addError('charset', tr('Configuration', "Field 'Charset' is required"));

		if (!count($this->_errors))
		{
			if (false === ($link = @mysql_connect($host, $username, $password)))
				$this->addError('password', tr('Configuration', 'Failed to establish database connection: invalid host, username or password'));
			else
			{
				if (false === @mysql_select_db($database, $link))
					$this->addError('database', tr('Configuration', 'Failed to use specified database'));
				mysql_close($link);
			}
		}

        return !count($this->_errors);
	}

	public function save($validate = true)
	{
		if ($validate && !$this->validate())
			return false;
		$s = "<?php\nreturn array(\n";
		$s .= "\t'host'=>'{$this->getAttribute('host')}',\n";
		$s .= "\t'username'=>'{$this->getAttribute('username')}',\n";
		$s .= "\t'password'=>'{$this->getAttribute('password')}',\n";
		$s .= "\t'database'=>'{$this->getAttribute('database')}',\n";
		$s .= "\t'charset'=>'{$this->getAttribute('charset')}',\n";
		$s .= ');';

		$f = fopen($this->_configFile, 'w+');
		if (false !== $f)
		{
			fwrite($f, $s);
			fclose($f);
		}
		
		if ($link = mysql_connect($this->getAttribute('host'), $this->getAttribute('username'), $this->getAttribute('password')))
		{
			mysql_select_db($this->getAttribute('database'), $link);
			$sql = <<< SQLSQSQL
CREATE TABLE IF NOT EXISTS `tbl_comment` (
	`ID` INT NOT NULL AUTO_INCREMENT COMMENT 'comment ID',
	`createTime` DATETIME NOT NULL COMMENT 'date and time of adding',
	`author` VARCHAR(100) NOT NULL COMMENT 'author\'s name',
	`email` VARCHAR(100) NOT NULL COMMENT 'author\'s e-mail address',
	`content` TEXT NOT NULL COMMENT 'comment text',	
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE='utf8_unicode_ci' COMMENT='Simple guest book with user comments'
SQLSQSQL;
			mysql_query($sql);
			mysql_close($link);
			return true;
		}
	}
}