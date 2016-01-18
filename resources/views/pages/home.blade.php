@extends('template')

@section('title')
    Home
@stop

@section('includes')
  <?php
    $fin_progress = $fin_status->cash_in_hand/$fin_status->target_budget;
    $fin_progress *= 100;
  ?>
  
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/css/mainpage.css') }}">
  <script type="text/javascript"
    src="{{ asset('/js/home.js') }}">
    </script>

@stop

@section('navigation')
    @include('../includes/navigation')
@endsection


@section('content')
<div class="col-md-12" id="fin-overlay-panel">
  <div class="card container">
    <div class="col-md-12" id='fin-form'>
    {!! Form::open(['url' => '/financial-status']) !!}
      <h4 class="section-title">Financial Status Report Update</h4>
      <hr>
      <p>Each group shall have four to five participants for this game.
      Members of the group will line-up horizontally.
      Each adjacent leg will be tied – legs that are not owned by the same person (see Figure 1).
      </p><br>
        <label name="cash_in">Weekly Cash In</label>
        <input type="number" name="cash_in" class="form-control" required/><br>
        <label name="cash_out">Weekly Cash Out</label>
        <input type="number" name="cash_out" class="form-control" required/><br>
        <label name="payables">Total Amout Payables</label>
        <input type="number" name="payables" class="form-control" required/><br>

        {!! Form::submit("UPDATE", ["class"=>"btn btn-primary form-control"]) !!}
      {!! Form::close() !!}
      <button class="btn btn-default form-control" id="close-fin-form">CLOSE</button>
    </div>   
  </div>
</div>

<div class="container" id="home-wrapper">
    <div class="row">
    <div class="col-md-8" id="home-left">
        <div class="col-md-12 section" id="section-header">        
            <center>
                <h2 class="section-title">{{ $event->title }} : {{ $event->theme }}</h2>
                <p>{{ $event->sem }}, {{ $event->year }}</p>
            </center>
        </div>
        
            <!--Overall Progress Chart-->
            <div class="col-md-6 section">
                <h4 class="section-title">Overall Progress</h4>
            </div>
            <!--Overall Progress Chart-->
            <div class="col-md-6 section">
                <h4 class="section-title">Committee Progress</h4>
            </div>

        <div class="col-md-12 section" id="fin-panel">
            <h4 class="section-title" id="fin-status-title"> FINANCIAL STATUS
                <?php
                    $is_fin_head = false;
                    $head = $heads->where('user_id', $user->id)->where('position', 'Finance Committee Head')->first();
                    if( $head != "") $is_fin_head = true;
                ?>
                @if( $is_fin_head)
                    <button class="btn btn-primary" id="fin-update" style="float:right">UPDATE</button>
                @endif
            </h4>

            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="{{ $fin_progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $fin_progress }}%"><span class="">{{ $fin_progress }}% of Target Budget</span></div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">                
                    <h5>Cash at Hand: </h5>
                    <h4>P{{ $fin_status->cash_in_hand }}</h4>
                </div>
                <div class="col-md-4">                
                    <h5>Payables: </h5>
                    <h4>P{{ $fin_status->payables }}</h4>
                </div>
                <div class="col-md-4">                
                    <h5>Target Budget: </h5>
                    <h4>P{{ $fin_status->target_budget }}</h4>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4 fin-card">
                    <div>
                        <h5>Weekly Cash In</h5>
                        <h2 class="value">P{{ $fin_status->cash_in }}</h2>
                    </div>
                </div>
                <div class="col-md-4 fin-card">
                    <div>
                        <h5>Weekly Cash Out</h5>
                        <h2 class="value">P{{ $fin_status->cash_out }}</h2>
                    </div>
                </div>
                <div class="col-md-4 fin-card">
                    <div>
                        <h5>Weekly Income</h5>
                        <h2 class="value">P{{ $fin_status->weekly_income }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-4" id="home-right">
        <div class="col-md-12 section">
            <h4 class="section-title">Task Reminders</h4>
            <table id="task-reminders">
            @if(count($tasks) == 0)          
                <h6>No pending tasks.</h6>
            @endif

            @if(count($tasks) > 0)          
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td class="deadline">{{ $task->deadline }}</td>
                </tr>
            @endforeach
            @endif
            </table>
        </div>

        <div class="col-md-12 section">
            <h4 class="section-title">Announcements</h4>
                @foreach($shouts as $shout)
                <div class="col-md-12 shout">
                    <p class="shout-body"> {{ $shout->shout }} </p>

                    <?php
                        $owner = "";
                        $id = $shout->user_id;
                        if($event->oah_id == $id) $owner = "Overall Activity Head";
                        else {
                          $head = $heads->where('user_id', $id)->first();
                          $owner = $head->position;
                        }
                    ?>

                    <h6 class="shout-owner">by {{ $owner }}<br>
                    {{ $shout->created_at }}<br>
                    </h6>
                </div>
                @endforeach
            <hr>
        </div>

        <div class="col-md-12 section shout-form">
        <?php
            $is_head = false;
            if($heads->where("user_id", $user->id) != '[]') $is_head = true;
            elseif ($event->oah_id == $user->id) $is_head = true;
        ?>
        @if($is_head)
        {!! Form::open(['url' => '/announcement']) !!}
            <h4 class="section-title">Post Announcement</h4>
            
            <div class="form-group">
                <textarea type="text" name="shout" class="form-control"/></textarea>
                <input type="hidden" name="event_id" value="{{ $event->id}}">
                <input type="hidden" name="user_id" value="{{ $user->id}}">
            </div>
            {!! Form::submit("POST", ["class"=>"btn btn-primary"]) !!}
          {!! Form::close() !!}
        @endif
        </div>

        </div>

    </div>

    </div>
</div>
@stop
