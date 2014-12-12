<?php

interface CalendarInterface{

		//Add event with data 
		public function addEvent($data,$createdUserId);
		//Get event for a particular date for the user with UserId
		public function getEvents($userId, $day);
		//Get all the event date for the user
		public function getEventDates($userId);
		//Get the event 
		public function getEvent($id);
		//Delete the event
		public function deleteEvent($id,$userId);
		//Update event
		public function editEvent($data, $updatedUserId);
		//Check permission
		public function checkPermission($eventId,$userId);
		//Get All Events created by specific user
		public function getEventsCreatedByUser($userId);
}