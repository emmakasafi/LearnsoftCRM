@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Lead</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('leads.index') }}">Back</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::model($lead, ['route' => ['leads.update', $lead->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    <!-- Full Name Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('full_name', 'Full Name:') !!}
                        {!! Form::text('full_name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 30]) !!}
                    </div>

                    <!-- Phone Number Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('phone_number', 'Phone Number:') !!}
                        {!! Form::number('phone_number', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Source Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('source', 'Source:') !!}
                        {!! Form::text('source', null, ['class' => 'form-control', 'maxlength' => 30]) !!}
                    </div>

                    <!-- Status Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::text('status', null, ['class' => 'form-control', 'maxlength' => 30]) !!}
                    </div>

                    <!-- Product Dropdown Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('product_id', 'Product:') !!}
                        {!! Form::select('product_id', ['' => 'N/A'] + $products->pluck('product_name', 'id')->toArray(), null, ['class' => 'form-control']) !!}
                    </div>


                    <!-- Employee Dropdown Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('employee_id', 'Employee:') !!}
                        {!! Form::select('employee_id', $employees->pluck('first_name', 'id'), null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Description Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('leads.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
