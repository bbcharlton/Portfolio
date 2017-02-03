<?php

class About extends AppController {
	public function __construct($parent) {
		$this->parent = $parent;
		$this->showList();
	}

	public function showList() {
		$data = $this->parent->getModel("fruits")->select("select * from fruit_table");

		$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About"),
					"API"=>array("API","/API/gb")
		);

		$random = substr( md5(rand()), 0, 7);

		$this->getView("header", $nav);

		$this->getView("about", $data);

		$this->getView("footer", array("cap"=>$random));
	}

	public function showAddForm() {
		$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About")
		);

		$random = substr( md5(rand()), 0, 7);

		$this->getView("header", $nav);

		$this->getView("addForm");

		$this->getView("footer", array("cap"=>$random));
	}

	public function showEditForm() {
		$data = $this->parent->getModel("fruits")->select("select * from fruit_table where id=:id",  array(":id"=>$this->parent->urlPathParts[2]));
		$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About")
		);

		$random = substr( md5(rand()), 0, 7);

		$this->getView("header", $nav);

		$this->getView("editForm", $data);

		$this->getView("footer", array("cap"=>$random));
	}

	public function addAction() {
		$data = $this->parent->getModel("fruits")->add("insert into fruit_table (name) values (:name)", array(":name"=>$_REQUEST["name"]));
		header("Location:/About");
	}

	public function editAction() {
		$data = $this->parent->getModel("fruits")->update("update fruit_table set name=:name where id=:id", array(":name"=>$_REQUEST["name"], ":id"=>(int)$this->parent->urlPathParts[2]));
		header("Location:/About");
	}

	public function deleteAction() {
		$data = $this->parent->getModel("fruits")->delete("delete from fruit_table where id=:id", array(":id"=>(int)$this->parent->urlPathParts[2]));
		header("Location:/About");
	}
}

?>