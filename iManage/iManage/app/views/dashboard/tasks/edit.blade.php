@extends('dashboard.default')
@section('head')
<title>iManage app - Edit Task</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">Dashboard<a> / <a href="{{url('/dashboard/tasks')}}">Tasks</a> / Edit</h2>
        <!-- Add New Task -->
        <div class="row-fluid add_new_task">
          <div class="span7 add_new_task_left" id="add_new_task_left">
            <form class="form-horizontal" action="#" id="newtaskform" method="post"  data-validate="parsley"  >
              <h3>
              <input type="text" name="task_name" id="task_name" class="task_create_in" value="{{$task['name']}}" placeholder="Task Name (required)" data-required="true" data-show-errors="false">
              </h3>
              <div class="add-proj-form add_task_form">
                <fieldset>
                  <div class="control-group">
                    <label>Kick off date:
                    </label>
                    <input id="startdate" name="startdate" type="text" class="span6 pull-left" value="{{new ExpressiveDate($task['start_date'])}}" placeholder="Start date" data-required="true" data-trigger="change">
                    <input id="enddate" name="enddate" type="text" class="span6 pull-right" value="{{new ExpressiveDate($task['end_date'])}}" class="span6 pull-right" placeholder="End date" data-required="true" data-trigger="change">
                  </div>
                  <div class="control-group">
                    <label>Project:
                      <p class="help-block">(optional)</p>
                    </label>
                    <select name="projectlist" id="projectlist" class="projectlist" tabindex="1">
                      @if($task['project_id'] == null)
                      <option name="" value="null" selected="selected" title="">None</option>
                      @else
                      <option name="" value="null"  title="">None</option>
                      @endif
                      @if($projects != null)
                      @foreach($projects as $project)
                      @if($project['id'] == $task['project_id'])
                      <option name="" value="{{$project['id']}}" selected="selected" title="">{{$project['project_name']}}</option>
                      @else
                      <option name="" value="{{$project['id']}}" title="">{{$project['project_name']}}</option>
                      @endif
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="control-group">
                    <label>Task Description:
                      <p class="help-block">(optional)</p>
                    </label>
                    <textarea id="note" class="add-proj-form-t" placeholder="Note">{{$task['note']}}</textarea>
                  </div>
                  <div class="control-group">
                    <label for="passwordinput">Task Owner:<span class="tooltipster-icon" title="To add the asignee start typing the name and select the appropriate user from the list. Please note that only those name will appear in list who are registered in the app. Please add your name as well if you are one of them.">(?)</span></label>
                    <div class="controls" style="margin:0;">
                      <div class="span12 flatui-detail" style="position:relative;">
                        <input id="plugin" name="passwordinput" type="text" placeholder="Add Name">
                      </div>
                      <div id="selected">
                        <ul id="list">
                          @foreach($task['users'] as $user)
                          <li id="userlist" class="userlist" email={{$user['email']}} >{{$user['first_name'].' '.$user['last_name']}}<a class="removeme" id="removeme" href="#">X</a></li>
                          @endforeach
                        </ul>
                        <input style="display: none;" name="tagsinput" id="tagsinput" class="tagsinput" placeholder="Add Name" value="{{$emailList}}"  />
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="add_task_button_main"><button class="add_task_submit">Update</a></button></div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="span5 add_new_task_right" id="add_new_task_right" >
            <h3>Confirm</h3>
            <div class="add-proj-form add_task_form" >
              <div class="row-fluid sub_task_list_main">
                <div class="add_task_button_main">
                  <a  href="{{url('/dashboard/task/added')}}" class="add_project">I am done here.</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('endjs')
{{ HTML::script('assets/js/jquery/jquery.blockUI.js') }}
{{ HTML::script('assets/js/dashboard/edittask.js') }}
<script>
 $(document).on("click", ".removeme", function() {
   var email = $(this).parent('li').attr('email');
   var emaillist = $('#tagsinput').val();
   newemaillist = $.grep(emaillist.split(','), function(v) {
     return v != email;
   }).join(',');
   $(this).parent().remove();
   $('#tagsinput').val(newemaillist);
 });
 $(function() {
   var editTaskModel = new EditTaskModel()
   var editTaskview = new EditTaskView({
     model: editTaskModel
   });
 });
</script>
{{ HTML::style('assets/css/dashboard/backbone.autocomplete.css') }}
{{ HTML::script('assets/js/dashboard/backbone.autocomplete.js') }}
{{ HTML::script('assets/js/dashboard/projectuserlist.js') }}
{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/dashboard/edittask.js') }}
{{ HTML::script('assets/js/dashboard/datecheck.js') }}
<script>
$(document).ready(function() {
  $('.tooltipster-icon').tooltipster();
});
</script>
@stop

