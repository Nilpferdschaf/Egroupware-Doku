<?php

class helloworld_bo
{
	private $so;

	function __construct()
	{
		$this->so = new helloworld_so ();
	}

	function get_formatted_employee_list()
	{
		$formatted_string = "";
		
		$employees = $this->so->get_employees ();
		foreach ($employees as $employee)
		{
			$formatted_string .= $this->emp_to_string ($employee);
		}
		return $formatted_string;
	}

	function emp_to_string($employee)
	{
		return $employee ['sname'] . ", " . $employee ['fname'] . " works as " . $employee ['position'] . " in " . $employee ['dep_name'] . ".\n";
	}

	function get_department_names()
	{
		return $this->so->get_department_names ();
	}

	function insert_employee($fname, $sname, $position, $dep_id)
	{
		return $this->so->insert_employee ($fname, $sname, $position, $dep_id);
	}

	function delete_employee($fname_select, $sname_select)
	{
		return $this->so->delete_employee ($fname_select, $sname_select);
	}

	function update_employee($fname_select, $sname_select, $fname_change, $sname_change, $position_change, $dep_id_change)
	{
		return $this->so->update_employee ($fname_select, $sname_select, $fname_change, $sname_change, $position_change, $dep_id_change);
	}
}