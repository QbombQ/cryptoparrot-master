@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Dashboard - CryptoParrot',
    ]
)
 
@section('content')

    @include('pages.AdminSubsystem.common.header') 
 
        <div class="row">

          @if(Session::has('alert'))
          <div class="col-xl-12 pb-2 mt-4">
              <div class="alert alert-warning">{!! session('alert') !!}</div>
          </div>
          @endif

    
        </div>

        <h2 class="mb-4 font-weight-bold">Dashboard</h2>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
        <div class="col-lg-4">


            <div class="row">
            <div class="col-xl-6 pb-4">
                <div class="card text-center h-100 d-flex">
                <div class="card-body p-4 d-flex">
                <div class="align-self-center w-100">
                <h3 class="font-weight-bold mb-0"> <i class="fad mr-2 fa-users fa-1x text-primary"></i> {{ count($users) }} <span class="mb-0 text-muted font-weight-normal small">Users</span></h3>
                </div>
                </div>
                </div>
            </div>
            <div class="col-xl-6 pb-4">
                <div class="card text-center h-100 d-flex">
                <div class="card-body p-4 d-flex">
                <div class="align-self-center w-100">
                <h3 class="font-weight-bold mb-0"> <i class="fad mr-2 fa-exchange fa-1x text-primary"></i> {{ $tradeCount }} <span class="mb-0 text-muted font-weight-normal small">Trades</span></h3>
                </div>
                </div>
                </div>
            </div>
            <div class="col-xl-6 pb-4">
                <div class="card text-center h-100 d-flex">
                <div class="card-body p-4 d-flex">
                <div class="align-self-center w-100">
                <h3 class="font-weight-bold mb-0"> <i class="fad fa-calendar-week fa-1x text-primary mr-2"></i> {{ count($usersActivity['todayUsers']) }} <span class="mb-0 text-muted font-weight-normal small">Active 24h  <a href="/admin/users/activity/today" class="small"><i class="fal fa-info-circle text-primary"></i></a> </span></h3>
                </div>
                </div>
                </div>
            </div>
             <div class="col-xl-6 pb-4">
                <div class="card text-center h-100 d-flex">
                <div class="card-body p-4 d-flex">
                <div class="align-self-center w-100">
                <h3 class="font-weight-bold mb-0"> <i class="fad fa-calendar-week fa-1x text-primary mr-2"></i> {{ count($usersActivity['thisWeekUsers']) }} <span class="mb-0 text-muted font-weight-normal small">Active last week  <a href="/admin/users/activity/this-week" class="small"><i class="fal fa-info-circle text-primary"></i></a> </span></h3>
                </div>
                </div>
                </div>
            </div>
            </div>

            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">Give badge</h5>
                <form method="post" id="assign-badge-form" enctype="multipart/form-data" action="/admin/badges/give" class="form-horizontal">
                        @csrf
                        <div class="row"> 
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    
                                    <select class="select2 form-control mb-3" name="badge_id">
                                        @foreach($badges as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                 
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                   
                                    <select class="select2 form-control mb-3" name="user_id">
                                        @foreach($users as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                  
                                </div>         
                            </div>  
                            <div class="col-12">                                                                                                  
                                <div class="form-group mb-0">
                                    <div class="">
                                        <button class="btn btn-block btn-primary" type="submit">Give</button>
                                    </div>
                                </div>
                            </div>
                        </div>                           
                    </form>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">Newsletter progress</h5>
                @if($newsletter['progress'] > 0)

                    <h2>
                    {{$newsletter['progress']}}% ({{$newsletter['usersPassed']}}/{{$newsletter['totalUsers']}})
                    </h2>

                    

                    <div class="progress progress-mini">
                        <div style="width: {{$newsletter['progress']}}%;" class="progress-bar"></div>
                    </div>

                    <div class="m-t-sm small">Started: {{$newsletter['startDate']}} | Finished: {{$newsletter['endDate']}}</div>

                    @if($newsletter['messagesSent'])
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Messages sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($newsletter['messagesSent']) > 0)
                                    @foreach($newsletter['messagesSent'] as $message)                 
                                        <tr> 
                                            <td class="align-middle">{{$message}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>Nothing to show</td></tr>
                                @endif
                            </tbody>
                        </table>
                    @endif

                    @if($newsletter['alreadySent'])
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Already sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($newsletter['alreadySent']) > 0)
                                    @foreach($newsletter['alreadySent'] as $message)                 
                                        <tr> 
                                            <td class="align-middle">{{$message}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>Nothing to show</td></tr>
                                @endif
                            </tbody>
                        </table>
                    @endif     

                    @if($newsletter['problematicUsers'])
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No email or newsletter turned off</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($newsletter['problematicUsers']) > 0)
                                    @foreach($newsletter['problematicUsers'] as $message)                 
                                        <tr> 
                                            <td class="align-middle">{{$message}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>Nothing to show</td></tr>
                                @endif
                            </tbody>
                        </table>
                    @endif 

                    @else

                    No active campaign

                    @endif                                      

              </div>
            </div>
      

           
        </div>
        <div class="col-lg-8">
 
                <div class="row">
                <div class="col-xl-6">

                 <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold">User growth <small>Last 6 months</small></h5>
                    <div>
                            <canvas id="userChart" height="140"></canvas>
                    </div>
                  </div>
                </div>

                </div>
                 <div class="col-xl-6">

                 <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold">Trades <small>Last 6 months</small></h5>
                    <div>
                            <canvas id="tradeChart" height="140"></canvas>
                    </div>
                  </div>
                </div>

                </div>
                </div>


      

                <div class="row">
                    <div class="col-lg-6">


                        <div class="mb-4">
                        <div class="">
                        <h5 class="card-title font-weight-bold px-2">Finished trades <small>with reserved sums</small></h5>

                            <table class="table table-hover table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Trade ID</th>
                                            <th>Username</th>
                                            <th>Reserved sum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($finishedTradesWithReservedSums) > 0)
                                            @foreach($finishedTradesWithReservedSums as $trade)                 
                                                <tr> 
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['tradeId']}}</span></span></td>
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['username']}}</span></span></td>
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['reservedSum']}}</span></span></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="3"><span class="td-holder"><span class="td-inner align-self-center w-100">No such trades</span></span></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            
                        </div>
                        </div>

                        <div class="mb-4">
                        <div class="">
                        <h5 class="card-title font-weight-bold px-2">Finished trades <small>with released reserve > 1</small></h5>
                   
                            <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Trade ID</th>
                                            <th>Username</th>
                                            <th>Reserved sum</th>
                                            <th>Times released</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($finishedTradesWithMoreThanOneRelease) > 0)
                                            @foreach($finishedTradesWithMoreThanOneRelease as $trade)                 
                                                <tr> 
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['tradeId']}}</span></span></td>
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['username']}}</span></span></td>
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['reservedSum']}}</span></span></td>
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['reserveReleased']}}</span></span></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="4"><span class="td-holder"><span class="td-inner align-self-center w-100">No such trades</span></span></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                    </div>
                    <div class="col-lg-6">
                   
                            <div class="mb-4">
                            <div class="">
                            <h5 class="card-title font-weight-bold px-2">Queued jobs <small></small></h5>
                   
     
                           
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($queuedJobs) > 0)
                                            @php
                                                $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                            @endphp
                                            @foreach($queuedJobs as $job)                 
                                                <tr> 
                                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$job['type']}}</span></span></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td><span class="td-holder"><span class="td-inner align-self-center w-100">No jobs in queue</span></span></td></tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                            </div>
                          
                       
                    </div>
                </div>                     
               
        </div>
        
    </div>

    
    @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script>
$(document).ready(function() {

    var lineData = {
        labels: <?= json_encode($last6MonthsUserStatuses['labels']) ?>,
        datasets: [
            {
                label: "Verified",
                backgroundColor: 'rgba(23,198,113,0.5)',
                borderColor: "rgba(23,198,113,0.7)",
                pointBackgroundColor: "rgba(23,198,113,1)",
                pointBorderColor: "#fff",
                data: <?= json_encode($last6MonthsUserStatuses['stats']['confirmed']) ?>
            },{
                label: "Not Verified",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: <?= json_encode($last6MonthsUserStatuses['stats']['unconfirmed']) ?>
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("userChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    var lineData = {
        labels: <?= json_encode($last6MonthsTrades['labels']) ?>,
        datasets: [

            {
                label: "Trades",
                backgroundColor: 'rgba(108,108,171, 0.5)',
                pointBorderColor: "#fff",
                data: <?= json_encode($last6MonthsTrades['stats']) ?>
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("tradeChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});



});
</script>

@endsection
