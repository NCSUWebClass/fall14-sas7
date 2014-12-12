<?php

interface TodoInterface{

		//Get Todos for User
		public function getTodos($userId);
		//Update Todo
		public function putTodos($data, $userId);
		//Add Todo
		public function postTodos($data, $userId);
		//Delete Todo
		public function deleteTodos($id);
		//Mark All Completed Todo
		public function markAllCompleted($userId);
		//Delete all completed Todo
		public function deleteCompleted($userId);
		//Delete All Todos
		public function deleteAll($userId);
}