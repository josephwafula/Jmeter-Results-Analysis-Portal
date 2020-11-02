@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Disclaimer: 
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif 				 
                   
                    @if(@Auth::user()->user_role == 'Other')
					
					The Test Results that you are about to see are not the final figures. A formal report will be prepared and shared by the responsible Test Engineer. The Test Results will keep changing until the test cyle is closed. </br>
					
                        <a href="{{ route('list-Other') }}" class="btn btn-primary">Proceed</a>
                    @elseif(@Auth::user()->user_role == 'QE')
					
					This is not the Final Report, Please write a Formal Performance Test Summary Report that will be joined with the Functional Test Summary Report for CAB submission. </br>
                        <a href="{{ route('list-QE') }}" class="btn btn-primary">Proceed</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
