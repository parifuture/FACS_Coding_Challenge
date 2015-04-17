<?php
class Standard_Model_Test_Mapper {
	public $sequence_number;

	public function __construct($sequence_number = null) {
		// $sequence_number = rand(1, 100);
		// $this->sequence_number = $sequence_number;
		$this->sequence_number = rand(1, 100);
	}

	public function save_new_item($item_text,$item_description) {
		// this function gets the values from the front end and
		// stores them in the database and returned the sequence
		// number
		// for the purpose of the exercise we are going to return
		// the id and add one to it
		$item_text++;
		return $item_text;

	}

	public function update_user_item($item_id,$user_id,$item_status) {
		// this function like the previous one gets the values from
		// the front end and updated them in the database based on
		// item_id and user_id and returs true or false based on
		// the record is sucessfully updated
		// for the purpose of the exercise we are going to return
		// true always
		return true;
	}

}

$cmd = htmlspecialchars($_POST["cmd"]);
error_log("cmd: $cmd, item_text: $item_text, item_description: $item_description",0);

if($cmd == "additem") {
	$item_text = htmlspecialchars($_POST["item_text"]);
	$item_description = htmlspecialchars($_POST["item_description"]);

	$add = new Standard_Model_Test_Mapper();
	$return_value = $add->save_new_item($item_text,$item_description);
} else if ($cmd == "updateitem") {
	$item_id = htmlspecialchars($_POST["item_id"]);
	$user_id = htmlspecialchars($_POST["user_id"]);
	$item_status = htmlspecialchars($_POST["item_status"]);
	// in this condition we will take the three values
	// item_id
	// user_id
	// item_status
	// and push them in the database
	$update = new Standard_Model_Test_Mapper();
	$return_value = $update->update_user_item($item_id,$user_id,$item_status);
}

error_log("return_value: $return_value",0);

header('Content-Type: application/json');
echo json_encode($return_value);


?>