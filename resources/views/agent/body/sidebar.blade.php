<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            Learning<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->status == 0)
                <li class="nav-item nav-category">Real Estate</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#type" role="button" aria-expanded="false"
                        aria-controls="type">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Propert Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="type">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('property_types.index') }}" class="nav-link">All Type</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('property_types.create') }}" class="nav-link">Add Type</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#cities" role="button" aria-expanded="false"
                        aria-controls="cities">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">City</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="cities">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">All City</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cities.create') }}" class="nav-link">Add City</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item nav-category">Components</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">UI Kit</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="uiComponents">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">All Country</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cities.create') }}" class="nav-link">Add Country</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                        aria-expanded="false" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Advanced UI</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="advancedUI">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="#" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
