<?php

class helloworld_so
{
	private $db;
	var $dep_names;

	function __construct()
	{
		$this->db = clone ($GLOBALS ['egw']->db);
		$this->db->set_app ('helloworld');
		$dep_select = $this->db->select ("departments", array(
				"dep_id",
				"dep_name"
		));
		
		$this->dep_names = array();
		foreach ($dep_select as $record)
		{
			$this->departments [$record ['dep_id']] = $record ['dep_name'];
		}
	}

	function get_department_names()
	{
		return $this->departments;
	}

	function insert_employee($fname, $sname, $position, $dep_id)
	{
		$this->db->insert ('employees', array(
				'fname' => $fname,
				'sname' => $sname,
				'position' => $position,
				'dep_id' => $dep_id,
				'emp_id' => $this->increment_emp_id ()
		));
	}

	function increment_emp_id()
	{
		$max = $this->db->select ("employees", "max(emp_id) as max")->fields ['max'];
		return 1 + $max;
	}

	function get_employees()
	{
		$sel_result = $this->db->select (
				// tables
				'departments, employees', 
				// columns
				array(
						'emp_id',
						'fname',
						'sname',
						'position',
						'departments.dep_id as dep_id',
						'dep_name'
				), 
				// WHERE (only for comparing columns to constants.)
				null, 
				// line number (for debugging)
				__LINE__, 
				// file name (for debugging)
				__FILE__, 
				// OFFSET
				false, 
				// Additional suffix to append to the query
				'ORDER BY sname DESC', 
				// The name of you app (false means use current app)
				false, 
				// LIMIT (0 for no limit)
				0, 
				// JOIN (for comparing columns to columns.)
				"where employees.dep_id = departments.dep_id");
		
		$employees = array();
		foreach ($sel_result as $record)
		{
			$employees [] = $record;
		}
		
		return $employees;
	}

	function delete_employee($fname_select, $sname_select)
	{
		return $this->db->delete (
				// table
				'employees', 
				// WHERE (comparing columns to constants)
				array(
						'fname' => $fname_select,
						'sname' => $sname_select
				));
	}

	function update_employee($fname_select, $sname_select, $fname_change, $sname_change, $position_change, $dep_id_change)
	{
		return $this->db->update (
				// table
				'employees', 
				// updated values
				array(
						'fname' => $fname_change,
						'sname' => $sname_change,
						'position' => $position_change,
						'dep_id' => $dep_id_change
				), 
				// WHERE (comparing columns to constants)
				array(
						'fname' => $fname_select,
						'sname' => $sname_select
				));
	}

	function get_employees_nm($query, &$rows, &$readonlys)
	{
		$rows = $this->get_employees ();
		

		if ($query ['search'])
		{
			$rows = array_filter ($rows, $this->get_string_filter ($query ['search']));
		}
		usort ($rows, $this->get_sort ($query ['order']));
		

		if ($query ['sort'] == 'DESC') $rows = array_reverse ($rows);
		return count ($rows);
	}

	function get_string_filter($string)
	{
		$string = strtolower ($string);
		return function ($cmp_arr) use ($string)
		{
			foreach ($cmp_arr as $entry)
			{
				if (strpos (strtolower ($entry), $string) !== false)
				{
					return true;
				}
			}
			return false;
		};
	}

	function get_sort($key)
	{
		return function ($a, $b) use ($key)
		{
			return strcmp (strtolower ($a [$key]), strtolower ($b [$key]));
		};
	}

	function delete_employee_by_id($emp_id)
	{
		return $this->db->delete ('employees', array(
				'emp_id' => $emp_id
		));
	}

	function read_employee($emp_id)
	{
		$sel_result = $this->db->select ('departments, 
		employees', array(
				'fname',
				'sname',
				'departments.dep_id as dep_id',
				'position'
		), array(
				'emp_id' => $emp_id
		), __LINE__, __FILE__, false, 'ORDER BY sname desc', false, 0, "WHERE employees.dep_id = departments.dep_id");
		
		foreach ($sel_result as $record)
		{
			return $record;
		}
	}
}