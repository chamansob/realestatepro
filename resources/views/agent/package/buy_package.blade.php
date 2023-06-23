@extends('agent.agent_dashboard')
@section('agent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">


        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                </li>
            </ol>
            <a href="{{ route('agent.properties.create') }}" class="btn btn-inverse-info">Add Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-3 mt-4">Choose a plan</h3>

                        <div class="container">
                            <div class="row">
                                @foreach ($plans as $plan)
                                    <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="text-center mt-3 mb-4">{{ ucfirst($plan->plan_name) }}</h4>
                                                <i data-feather="{{ $plan->plan_icon }}"
                                                    class="text-{{ $plan->plan_color }} icon-xxl d-block mx-auto my-3"></i>
                                                <h1 class="text-center">$ {{ $plan->plan_amount }}</h1>
                                                <p class="text-muted text-center mb-4 fw-light">
                                                    {{ ucfirst($plan->plan_subheading) }}
                                                </p>
                                                <h5 class="text-{{ $plan->plan_color }} text-center mb-4">
                                                    {{ ucfirst($plan->plan_heading) }}
                                                </h5>
                                                <table class="mx-auto">
                                                    <tr>
                                                        <td><i data-feather="check" class="icon-md text-success me-2"></i>
                                                        </td>

                                                        <td>
                                                            <p>Up to {{ $plan->plan_credit }} Property</p>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $fe = $plan->fe_In($plan->plan_pack_id);
                                                    ?>
                                                    @foreach ($fe as $feature)
                                                        <tr>
                                                            <td><i data-feather="check"
                                                                    class="icon-md text-success me-2"></i>
                                                            </td>
                                                            <td>
                                                                <p>{{ $feature->features_name }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <?php
                                                    $fe = $plan->fe_Not_In($plan->plan_pack_id);
                                                    ?>
                                                    @foreach ($fe as $feature)
                                                        <tr>
                                                            <td><i data-feather="x" class="icon-md text-danger me-2"></i>
                                                            </td>
                                                            <td>
                                                                <p class="text-muted">{{ $feature->features_name }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table>
                                                <div class="d-grid">
                                                    <a href="{{ route('agent.buy.plan', $plan->id) }}"
                                                        class="btn btn-{{ $plan->plan_color }} mt-4">Start
                                                        Now </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
