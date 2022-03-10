@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="timezone" id="timezone">
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="task-description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-9">
                            <textarea name="description" id="task-description" class="form-control" cols="30" rows="4" maxlength="30" >{{ old('task') }}</textarea>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="task-deadline" class="col-sm-2 control-label">Deadline</label>
                            <div class="col-sm-9">
                            <input type="datetime-local" id="task-deadline" class="form-control" value="{{ old('task') }}" name="deadline">
                            </div> 
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Deadline</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody id="body_for_tasks">
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
<script>
    var tasks = <?php echo json_encode($tasks); ?>;
    var csrf_field = <?php echo json_encode(csrf_token()); ?>;
    var url = <?php echo json_encode(url('task/')); ?>;
    $( document ).ready(function() {
        $('#timezone').val(moment.tz.guess());
        var user_timezone = moment.tz.guess();
        if(tasks != null && tasks.length > 0)
		{
            var table = "";
            Object.keys(tasks).forEach(function(key) {
                
                const myArray = tasks[key].deadline.split(" ");
                const date_str = myArray[0] + "T" + myArray[1] + "+00:00";
                const date = new Date(date_str);
                tasks[key].deadline = date.toLocaleString();
                
                const date_two = new Date();
                var startTime = moment(date_two.toLocaleString());
                var endTime = moment(tasks[key].deadline);

                const difference = endTime.diff(startTime, 'hours');

                table += " <tr> ";
                table += " <td class='table-text'><div> ";
                table += tasks[key].name;
                table += " </div></td> ";
                table += " <td class='table-text'><div> ";
                table += tasks[key].description;
                table += " </div></td> ";
                table += " <td class='table-text'>";
                if( difference > 0 )
                {
                    table += "<div> " + difference + " Hours Left";
                }
                else if( difference == 0 )
                {
                    table += "<div style='color: #d08729;'> " + difference + " Hour";
                }
                else
                {
                    table += "<div style='color: #bf3535;'> " + difference + " Hours Pass";
                }

                table += " </div></td> ";
                table += " <td> <form action='" + url + "/" + tasks[key].id + "' method='POST'><button type='submit' class='btn btn-danger'> <i class='fa fa-btn fa-trash'></i> ";
                table += "<input type='hidden' name='_token' value='" + csrf_field + "'>";
                table += "<input type='hidden' name='_method' value='DELETE'>";
                table += " Delete </button></form> </td> ";
                table += " </tr> ";
			});
            $("#body_for_tasks").append(table);
        }
    });        
</script>
