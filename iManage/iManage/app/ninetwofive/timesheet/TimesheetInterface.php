<?php

interface TimesheetInterface{

		//Gets tasks for the users
		public function getIndex($userId);
		//Add Timesheet Entry
		public function addEntry($data, $userId);
		//Get Timesheet Entries for a particular day and for UserId
		public function getEntries($day,$userId);
		//Delete Timesheet Entry
		public function deleteEntry($id);
		//Get Week
		public function getWeek($date);
		//Get Timesheet Entry
		public function getEntry($id);
		//Edit Timesheet Entry
		public function editEntry($data);
		//Check Permission
		public function checkPermission($entryId,$userId);
}