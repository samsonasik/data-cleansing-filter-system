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

                    {{ Form::open(['route' => ['import']]) }}

                    <div style="overflow: hidden;overflow-x: auto;width: 100%">

                        <table class="table table-striped table-bordered table-hover" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Region</th>
                                    <th>PostCode</th>
                                    <th>Country Code</th>
                                    <th>Telephone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($customers->isEmpty())
                                    <tr>
                                        <td align="center" colspan="9">Customer data already imported.</td>
                                    </tr>
                                @else
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->title }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->date_of_birth }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->region }}</td>
                                            <td>{{ $customer->postcode }}</td>
                                            <td>{{ $customer->country_code }}</td>
                                            <td>{{ $customer->telephone }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>

                    {{ Form::submit('Import') }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection