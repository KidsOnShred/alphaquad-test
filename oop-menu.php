<?php
	
	  // Database credentials
	define('HOST', 'localhost');
    define('USER', 'angeltes_root');
    define('PASS', 'afsfasfd');
    define('NAME', 'angeltes_main');

	class Core
	{
		public $mDb; // handle of the db connection
		private static $instance;
	
		private function __construct()
		{
			// Create a database object
			try {
				$dsn = "mysql:host=".HOST.";dbname=".NAME;
				$this->mDb = new PDO($dsn, USER, PASS);
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
				exit;
			}
			
		}
	
		public static function getInstance()
		{
			if (!isset(self::$instance))
			{
				$object = __CLASS__;
				self::$instance = new $object;
			}
			return self::$instance;
		}
	}

	class Menu
	{
		private $links;

		public function __construct($core)
		{
			//Get parents from database
			$sql = "SELECT * FROM links WHERE parentId IS NULL";
			$result = $core->mDb->prepare($sql);
			$result->execute();

			$i = 1;
			while ($Link = $result->fetch(PDO::FETCH_OBJ))
			{
				//Add Parents to list
				$this->links[$i] = new Link($core->mDb, $Link);
				$i++;
			}			
		}
		public function displayMenu()
		{
			//display menu
			if (count($this->links) > 0)
			{
				echo '<ul>';
				foreach ($this->links as $link)
				{
					$link->display();
				}
				echo '</ul>';
			}
		}
	}

	class Link
	{
		private $id;
		private $label;
		private $url;
		private $enabled;
		private $htmlOptions;
		private $linkOptions;
		private $links;

		public function __construct($db, $Link)
		{
			//Fill attributes
			$this->id = $Link->id;
			$this->label = $Link->label;
			$this->url = $Link->url;
			$this->enabled = $Link->enabled;

			//Get HTMLOptions
			$sql = "SELECT * FROM htmlOptions WHERE linkId = :id";
			$result = $db->prepare($sql);
			$result->execute(array(':id'=>$this->id));

			$i = 1;
			while ($option = $result->fetch(PDO::FETCH_OBJ))
			{
				$this->htmlOptions[$i] = $option->type . '="'. $option->value .'" ';
				$i++;
			}

			//Get LinkOptions
			$sql = "SELECT * FROM linkOptions WHERE linkId = :id";
			$result = $db->prepare($sql);
			$result->execute(array(':id'=>$this->id));

			$i = 1;
			while ($option = $result->fetch(PDO::FETCH_OBJ))
			{
				$this->linkOptions[$i] = $option->type . '="'. $option->value .'" ';
				$i++;
			}


			//Get children from database - have to use parentId ASC here
			$sql = "SELECT * FROM links WHERE parentId = :id";
			$result = $db->prepare($sql);
			$result->execute(array(':id'=>$this->id));

			$i = 1;
			while ($Link = $result->fetch(PDO::FETCH_OBJ))
			{
				$this->links[$i] = new Link($db, $Link);
				$i++;
			}
		}
		public function display()
		{
			//Display each list item
			echo '<li>';
	
			$this->highlightLabel();
			echo $this->createLink();

			if (count($this->links) > 0)
			{
				echo '<ul>';
				foreach ($this->links as $link)
				{
					$link->display();
				}
				echo '</ul>';
			}

			echo '</li>';
		}
		public function highlightLabel()
		{
			//Highlight where neccessary
			if (!$this->enabled)
				$this->label = '<del>'.$this->label.'</del>';
			if ($this->isActive())
				$this->label = '<b>'.$this->label.'</b>';
		}
		public function createLink()
		{		
			//Get HTML/Link Options
			$options = $this->getOptions();

			//Add url if neccessary
			if (!empty($this->url))
				return '<a href="'.$this->url.'" '.$options.'>'.$this->label.'</a>';
			return $this->label;
		}
		public function getOptions()
		{
			//Turn options into string for DOM
			$options = '';		

			if (count($this->htmlOptions) > 0)
			{
				foreach ($this->htmlOptions as $option)
				{
					$options .= $option;
				}
			}
			if (count($this->linkOptions) > 0)
			{
				foreach ($this->linkOptions as $option)
				{
					$options .= $option;
				}
			}
			return $options;
		}
		public function isActive()
		{
			//Check if has active class (for bold links I would just use css)
			$active = false;
			if (count($this->htmlOptions) > 0)
			{
				foreach ($this->htmlOptions as $option)
				{
					if (substr_count($option, 'active'))
						$active = true;
				}
			}
			return $active;
		}
	}

	// Create MySQL Connection using Core class
	$core = Core::getInstance(); 

	//Create Menu object
	$Menu = new Menu($core);

	//Display Menu
	$Menu->displayMenu();
?>