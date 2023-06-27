@props([
    'name' => '',
    'link' => 1,
    'bread' => '',
])
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('backend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('backend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ ucfirst($name) }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="#">Home</a></li>
                @if ($link)
                    <li><a href="{{ url('/dashboard') }}">Dashbord</a></li>
                @endif
                <li>{{ ucfirst($bread) }}</li>
            </ul>
        </div>
    </div>
</section>
