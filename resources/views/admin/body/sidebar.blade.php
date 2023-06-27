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
                <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                    aria-controls="property">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Property</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="property">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('properties.index') }}" class="nav-link">All Property</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('properties.create') }}" class="nav-link">Add Property</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false"
                    aria-controls="amenities">
                    <i class="link-icon" data-feather="star"></i>
                    <span class="link-title">Amenities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="amenities">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('amenities.index') }}" class="nav-link">All Amenities</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('amenities.create') }}" class="nav-link">Add Amenities</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#image_preset" role="button" aria-expanded="false"
                    aria-controls="image_preset">
                    <i class="link-icon" data-feather="airplay"></i>
                    <span class="link-title">Image Preset</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="image_preset">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('image_preset.index') }}" class="nav-link">All Image Preset</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('image_preset.create') }}" class="nav-link">Add Image Preset</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#agents" role="button" aria-expanded="false"
                    aria-controls="agents">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Manage Agent</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="agents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.agents') }}" class="nav-link">All Agent</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.agent_add') }}" class="nav-link">Add Agent</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">

                <a href="{{ route('admin.package_history') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>

                    <span class="link-title">Package History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#plan" role="button" aria-expanded="false"
                    aria-controls="plan">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Plan</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="plan">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('plan.index') }}" class="nav-link">All Plan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('plan.create') }}" class="nav-link">Add Plan</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#planfeature" role="button"
                    aria-expanded="false" aria-controls="planfeature">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Plan Feature</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="planfeature">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('planFeatures.index') }}" class="nav-link">All Plan Feature</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('planFeatures.create') }}" class="nav-link">Add Plan Feature</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.property.message') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Property Message </span>
                </a>
            </li>
            <li class="nav-item nav-category">Other</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#country" role="button" aria-expanded="false"
                    aria-controls="country">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Country</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="country">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('countries.index') }}" class="nav-link">All Country</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('countries.create') }}" class="nav-link">Add Country</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                    aria-controls="state">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">State</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="state">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('states.index') }}" class="nav-link">All States</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('states.create') }}" class="nav-link">Add States</a>
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
