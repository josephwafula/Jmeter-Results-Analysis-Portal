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
                <div class="card-header"> Test Runs 
				<a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
				</div>

                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
							    <th>Test Run</th>
								<th>Duration</th>
                                <th>Engineer</th>
								<th>Test Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if($data)
                                @foreach($data as $test_run)
                                <tr data-href="{{ URL::route('chart', array('run_id' => $test_run->run_type_id )) }}">
									<td>{{ $test_run->name }}</td>
									<td>{{ $test_run->duration }}</td>
                                    <td>{{ $test_run->createdby }}</td>
									<td>{{ $test_run->created_at }}</td>
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
