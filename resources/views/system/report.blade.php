@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Form</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div style="overflow: hidden;overflow-x: auto;width: 100%">

                        <table class="table table-striped table-bordered table-hover" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <th>Score</th>
                                    <th>Customer ID</th>
                                    <th>Title Suggestion</th>
                                    <th>Name Suggestion</th>
                                    <th>Email Suggestion</th>
                                    <th>DOB Suggestion</th>
                                    <th>Address Suggestion</th>
                                    <th>City Suggestion</th>
                                    <th>Region Suggestion</th>
                                    <th>PostCode Suggestion</th>
                                    <th>Country Code Suggestion</th>
                                    <th>Telephone Suggestion</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                    <button name="truncate">Truncate data to retry import</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection