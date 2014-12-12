<?php

interface ProjectInterface{

	//Get all projects for the user
	function getProjects($userId);
	//Add Project with data
	function addProject($data, $createdUserId);
	//Check Permission 
	function checkPermission($projectId,$userId,$action);
	//Get a specific project
	function getProject($projectid);
	//Ger project data for edit
	function getProjectForEdit($projectId);
	//Update data for project
	function updateProject($data,$userId);
	//Delete project
	function deleteProject($projectId,$userId);
}
