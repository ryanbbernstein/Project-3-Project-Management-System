<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function tasks_management()
	{
		$crud = new grocery_CRUD();
		$crud->set_Theme('datatables');
		$crud->set_Table('task');
		$crud->columns('ID','NAME','RESOURCE','EXPECTED_DURATION','ACTUAL_DURATION','EXPECTED_EFFORT','ACTUAL_EFFORT','EXPECTED_START','EXPECTED_END','ACTUAL_START','ACTUAL_END','PERCENT_COMPLETED','EFFORT_COMPLETED');
		$crud->display_as('RESOURCE','RESOURCE ASSIGNED');
		$crud->set_subject('Task');
		$crud->set_relation('RESOURCE','resource','NAME');
		$crud->set_relation_n_n('PREDECESSOR TASKS','task_task', 'task','SUCCESSOR', 'PREDECESSOR', 'NAME');
		$crud->set_relation_n_n('SUCCESSOR TASKS', 'task_task', 'task', 'PREDECESSOR', 'SUCCESSOR', 'NAME');
		$crud->callback_after_update(array($this, 'updateTasks'));
		$crud->callback_after_insert(array($this, 'updateTasks'));
		
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	function updateTasks($post_array,$primary_key)
	{
		//show_error(array_keys($post_array));
		if (array_key_exists("Predecessor_Tasks", $post_array)) {
			// UPDATE PREDECESSOR TASKS
			//$query = $this->db->query("SELECT * FROM task_task WHERE SUCCESSOR='".$primary_key."'");
			$this->db->delete('task_task', array('SUCCESSOR' => $primary_key));
			foreach ($post_array["Predecessor_Tasks"] as $PREDECESSOR) {
				$this->db->insert('task_task', array('PREDECESSOR' => $PREDECESSOR, 'SUCCESSOR' => $primary_key));
			}
			unset($post_array["Predecessor_Tasks"]);
		}
		if (array_key_exists("Successor_Tasks", $post_array)) {
			// UPDATE SUCCESSOR TASKS
			//$query = $this->db->query("SELECT * FROM task_task WHERE PREDECESSOR='".$primary_key."'");
			$this->db->delete('task_task', array('PREDECESSOR' => $primary_key));
			foreach ($post_array["Successor_Tasks"] as $SUCCESSOR) {
				$this->db->insert('task_task', array('SUCCESSOR' => $SUCCESSOR, 'PREDECESSOR' => $primary_key));
			}
			unset($post_array["Successor_Tasks"]);
		}
		
		return $post_array;
	}
	
	public function action_item_management()
	{
		$crud = new grocery_CRUD;
		$crud->set_Theme('datatables');
		$crud->set_Table('action_item');
		$crud->columns('ID','NAME', 'DESCRIPTION', 'PRIORITY','SEVERITY', 'DATE_RAISED','DATE_ASSIGNED','RESOURCE','EXPECTED_DATE','ACTUAL_DATE','STATUS','STATUS_DESCRIPTION','ASSOCIATED_ISSUE');
		$crud->display_as('RESOURCE','RESOURCE ASSIGNED');
		$crud->display_as('EXPECTED_DATE','EXPECTED COMPLETED DATE');
		$crud->display_as('ACTUAL_DATE','ACTUAL COMPLETED DATE');
		$crud->set_subject('Action Item');
		$crud->set_relation('ASSOCIATED_ISSUE','issue','NAME');
		$crud->set_relation('RESOURCE','resource','NAME');
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	public function deliverable_management()
	{
		$crud = new grocery_CRUD;
		$crud->set_Theme('datatables');
		$crud->set_Table('deliverable');
		$crud->columns('ID', 'NAME', 'DESCRIPTION', 'DUE_DATE');
		$crud->display_as('RESOURCE','RESOURCE ASSIGNED');
		$crud->set_subject('Deliverable');
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	public function issue_management()
	{
		$crud = new grocery_CRUD;
		$crud->set_Theme('datatables');
		$crud->set_Table('issue');
		$crud->columns('ID','NAME', 'DESCRIPTION', 'PRIORITY','SEVERITY', 'DATE_RAISED','DATE_ASSIGNED','RESOURCE','EXPECTED_DATE','ACTUAL_DATE','STATUS','STATUS_DESCRIPTION');
		$crud->display_as('RESOURCE','RESOURCE ASSIGNED');
		$crud->set_relation('RESOURCE','resource','NAME');
		$crud->display_as('TASK','TASK(S) AFFECTED');
		$crud->set_relation_n_n('TASK(S) AFFECTED','issue_task','task','TASK','ID','NAME');
		$crud->set_subject('Issue');
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	public function resource_management()
	{
		$crud = new grocery_CRUD;
		$crud->set_Theme('datatables');
		$crud->set_Table('resource');
		$crud->set_subject('Resource');
		$output = $crud->render();
		$this->_example_output($output);
	}

}
?>