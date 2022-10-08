@extends('layouts.app')

<!-- CSS -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript"> 
 //format the summary table.
$(document).ready(function(){
    $('#example td.response').each(function(){
        var num = parseFloat($(this).text());
        if (num > 3.0) {
            $(this).css('color','Red');
			$(this).css('font-weight','bold');
        } else if (num <= 3.0) {
            $(this).css('color','Green');
        }
    });
	
	  $('#example td.error').each(function(){
        var num = parseFloat($(this).text());
        if (num > 0.1) {
           $(this).css('color','Red');
		   $(this).css('font-weight','bold');
        } else if (num <= 0.1) {
           $(this).css('color','Green');
        }
    });
 	 
});
</script> 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> TPS achieved: {{ $TPS }} vs TPS Needed: @foreach($expectedTPS as $tps) {{ $tps->expected_TPS }} @endforeach
				<a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
					</div>
                <div class="card-body">
                    <table id="example" class="display" style="width:100%;font-family: monospace;">
                        <thead>
                            <tr>
							    <th>App Under Test</th>
								<th>Achieved TPS</th>
								<th>Response Times</th>
								<th>Errors</th>
                                <th>Engineer</th>
								<th>Test Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if($data)
                                @foreach($data as $summary)
                                <tr>
									<td>{{ $summary->endpoint }}</td>
									<td class="tps">{{ $summary->AVG_TPS }} </td>
									<td class="response"> {{ $summary->AVG_response_time }} </td>
									<td class="error"> {{ $summary->error_rate }}</td>
									<td>{{ $summary->createdby }}</td>
									<td>{{ $summary->created_at }}</td>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });	
</script>
@endsection
