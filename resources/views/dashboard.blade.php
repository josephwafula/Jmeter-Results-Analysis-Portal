@extends('layouts.app')
<!-- CSS -->
<style>
.blink {
    animation: blinker-one 1s linear infinite;
	color: #2eb346;
	font-family: sans-serif;
      }
    @keyframes blinker-one {
        0% {
        opacity: 0;
        }
      }

#dash {
    width: 100%;
    max-width: 700px;
    margin: 2em auto;
}
.cols {
    -moz-column-count:4;
    -moz-column-gap: 3%;
    -moz-column-width: 30%;
    -webkit-column-count:3;
    -webkit-column-gap: 3%;
    -webkit-column-width: 30%;
    column-count: 4;
    column-gap: 3%;
    column-width: 30%;
}
.box {
    margin-bottom: 20px;
    height:100px;
    background:#BFBFBF;
	font-size: 37px;
    text-align-last: center;
	border: 1px solid;	
}

.boxh {
   font-size: 13px;
   text-align-last: center;	
   font: -webkit-control;
   font-weight: bold;
}

</style>

<!-- CHARTS -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
	        /*chart 1*/
		var data = new google.visualization.DataTable(<?=$jsonTable?>);
				
		var options = {
			height: 350,
			chart: {
			title: 'Response Time vs Users',
				},
			series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
				},
			vAxes: {
            // Adds titles to each axis.
            0: {title: 'Response Time(ms)'},
            1: {title: 'Users'}
				},
			colors: ["green", "blue"],
			legend: { position: "bottom" },
			pointSize: 4,
			axes: {
				y: {
					'Response': {label: 'Response'},
					'Users': {label: 'Users'}
         }
      }
   };
   // Instantiate and draw the chart.
	var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
	  
	  //format the summary table.
$(document).ready(function(){
	$('#example').DataTable();
    $('#example td.response').each(function(){
        var num = parseFloat($(this).text());
        if (num > 3000.0) {
            $(this).css('color','Red');
			$(this).css('font-weight','bold');
        } else if (num <= 3000.0) {
            $(this).css('color','Green');
			$(this).css('font-weight','bold');
        }
    });
	
	  $('#example td.error').each(function(){
        var num = parseFloat($(this).text());
        if (num > 0.1) {
           $(this).css('color','Red');
		   $(this).css('font-weight','bold');
        } else if (num <= 0.1) {
           $(this).css('color','Green');
		   $(this).css('font-weight','bold');
        }
    });

	var tps = document.getElementById('tps').innerHTML;
	document.getElementById("tps").innerHTML = parseFloat(tps).toFixed(1);
	
	var response = document.getElementById('response').innerHTML;
	document.getElementById("response").innerHTML = parseFloat(response).toFixed(1);
	     if (response > 3000.0) {
            document.getElementById('response').style.color = "red";
	     } else if (response <= 3000.0) {
            document.getElementById('response').style.color = "green";
        }
	
	var errors = document.getElementById('errors').innerHTML;
	document.getElementById("errors").innerHTML = parseFloat(errors).toFixed(1);
	     if (errors > 0.1) {
            document.getElementById('errors').style.color = "red";
	     } else if (errors <= 0.1) {
           document.getElementById('errors').style.color = "green";
        }
	
	var slowest = document.getElementById('slowest').innerHTML;
	document.getElementById("slowest").innerHTML = parseFloat(slowest).toFixed(1);
     
});

</script>   
	  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> DashBoard
				<a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
				</div>
                <div class="card-body">
					    <table id="dash" style="width:100%;margin-top:4%;font-family: monospace;">
                        <thead>
                            <tr>
							    <th class="box" id="tps">@foreach($averagetps as $tps){{ $tps->avgtps }}@endforeach</th>
								<th class="box" id="response">@foreach($averageresponse as $response){{ $response->avgres }}@endforeach</th>
								<th class="box" id="errors">@foreach($errors as $error){{ $error->errors }}@endforeach</th>
								<th class="box" id="slowest">@foreach($slowest as $slow){{ $slow->slowest }}@endforeach</th>
							</tr>
                        </thead>
                        <tbody>
                                <tr>
									<td class="boxh">TPS</td>
									<td class="boxh">AVG Response Time(ms)</td>
									<td class="boxh">Error(%)</td>
									<td class="boxh">Max Response Time(ms)</td>
								</tr>
                        </tbody>

                    </table>
				
				<div id="chart_div" style="width:100%"> <p class="blink"> Generating Graph... This may take upto 5 Minutes. Please wait.....</p> </div>
				
			    <table id="example" class="display" style="width:100%;margin-top:4%;font-family: monospace;">
                        <thead>
                            <tr>
							    <th>EndPoint</th>
								<th>Average TPS</th>
								<th>Response Time</th>
								<th>Total Samples</th>
								<th>Failed Samples</th>
							</tr>
                        </thead>
                        <tbody>
                            
                            @if($dtable)
                                @foreach($dtable as $summary)
                                <tr>
									<td>{{ $summary->label }}</td>
									<td>{{ $summary->AVGTPS }} </td>
									<td class="response">{{ $summary->AVGRes }}</td>
									<td> {{ $summary->Requests }} </td>
									<td class="error"> {{ $summary->SuccessRate }}</td>
								</tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>	
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
