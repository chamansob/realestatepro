@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Plan</li>
                </li>
            </ol>
            <a href="{{ route('plan.index') }}" class="btn btn-inverse-info">Show All Plan</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Plan</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['plan.update', $plan->id],
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('plan_name', 'Plan Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('plan_name', $value = $plan->plan_name, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Name',
                                    ]) !!}
                                    @error('plan_name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_icon', 'Plan Icon', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_icon', $value = $plan->plan_icon, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Icon',
                                    ]) !!}
                                    @error('plan_icon')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_heading', 'Plan Heading', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_heading', $value = $plan->plan_heading, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Heading',
                                    ]) !!}
                                    @error('plan_heading')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_subheading', 'Plan Sub Heading', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_subheading', $value = $plan->plan_subheading, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Sub Heading',
                                    ]) !!}
                                    @error('plan_subheading')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_amount', 'Plan Amount', ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_amount', $value = $plan->plan_amount, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Amount',
                                    ]) !!}
                                    @error('plan_amount')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    {!! Form::label('plan_pack_id', 'Plan Features', ['class' => 'form-label']) !!}
                                    {!! Form::select('plan_pack_id[]', $value = $features, explode(',', $plan->plan_pack_id), [
                                        'class' => 'form-control js-example-basic-multiple',
                                        'multiple' => true,
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_credit', 'Plan Credit', ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_credit', $value = $plan->plan_credit, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Credit',
                                    ]) !!}

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <?php $color = ['success' => 'Success', 'danger' => 'Danger', 'info' => 'Info', 'primary' => 'Primary', 'warning' => 'Warning']; ?>
                                <div class="mb-3">
                                    {!! Form::label('plan_color', 'Plan Color', ['class' => 'form-label']) !!}
                                    {!! Form::select('plan_color', $value = $color, $plan->plan_color, [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
