@extends('layouts.app')
<style>
[data-href] {
    cursor: pointer;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Performance Test Exit Criteria Outline
				<a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
				</div>

                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
								<th>Project Name</th>
                                <th>TPS Required</th>
                                <th>% of Errors Acceptable</th>
								<th>Max Allowed Response Time </th>
                                <th>Max CPU Usage</th>
                                <th>Max RAM Usage</th>
								<th>Engineer</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if($data)
                                @foreach($data as $project)
                                <tr data-href="{{ URL::route('test_runs', array('project_id' => $project->project_id )) }}">
									<td>{{ $project->project_name }}</td>
									<td>{{ $project->expected_TPS }}</td>
                                    <td>Less than 1%</td>
                                    <td>Less than 3 Seconds</td>
									<td>Less than 50%</td>
                                    <td>Less than 50%</td>
                                    <td>{{ $project->createdby }}</td>
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
	
	jQuery(document).ready(function($) {
    $('*[data-href]').on('click', function() {
        window.location = $(this).data("href");
    });
});
</script>
@endsection
