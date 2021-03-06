<?php

interface ReportInterface{

		//Get Tasks List for the User
		public function getTasks($userId);
		//Get Project List for the User
		public function getProjects($userId);
		//Generate Weekly Report
		public function generateWeeklyReport($dates, $userId);
		//Generate Weekly Task Report
		public function generateWeeklyTaskReport($dates,$taskId,$userId);
		//Generate Weekly Project Report
		public function generateWeeklyProjectReport($dates,$projectId,$userId);
		//Generate Complete Project Report
		public function generateProjectReport($projectId,$userId);
		

}
