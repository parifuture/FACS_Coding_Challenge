<?php
class FACS {
	public $first_name;
	public $last_name;
	public $phone_number;
	public function __construct($first_name = null, $last_name = null) {
		$this->first_name = $first_name;
		$this->last_name = $last_name;
	}

	public function get_added_items() {
		return $this->first_name . " " . $this->last_name;
	}

	public function get_deleted_items() {
		return $this->first_name . " " . $this->last_name;
	}

	public function add_item($name) {
		$split_name = explode(" ", $name, 2);
		$length = count($split_name);
		$rv = true;
		if ($length === 0) {
			$rv = false;
		}
		elseif ($length === 1) {
			$this->first_name = $this->last_name = $split_name[0];
		}
		else {
			$this->first_name = $split_name[0];
			$this->last_name = $split_name[1];
		}
		return $rv;
	}
}
?>
<!doctype html>
<html>
	<head>
		<title>FACS - Coding Challenge</title>
		<link rel="stylesheet" type="text/css" href="assets/css/default.css">
		<script type="text/javascript" src="assets/js/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="assets/js/Test.js"></script>
	</head>
	<body>
		<div class="container">
			<h3>FACS Coding Challenge Goes Below</h3>
			<input type="hidden" value="0" name="count" id="count">
			<div id="addedItemsContainer" class="facs-box">
				<table class="table" id="addedItemsTable">
					<tr></tr>
				</table>
			</div>
			<div id="deletedItemsContainer" class="facs-box" style="display:none;">
				<table class="table" id="deletedItemsTable">
					<tr></tr>
				</table>
			</div>
			<div class="footer">
				<button id="addItemButton" onclick="AddItem();" class="facs-button-active">Add Item</button>
				<button id="deleteItemButton" onclick="UpdateItem();" class="facs-button-active" style="display:none;" disabled>Delete Item</button>
			</div>
		</div>
	</body>
</html>