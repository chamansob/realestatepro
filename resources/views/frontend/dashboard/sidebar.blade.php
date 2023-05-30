<div class="sidebar-widget category-widget">
    <div class="widget-title">
        <h4>Category</h4>
    </div>
    <div class="widget-content">
        <ul class="category-list ">
            <li class="current"> <a href="{{ route('dashboard') }}"><i class="fab fa fa-envelope "></i>
                    Dashboard </a></li>
            <li><a href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i>
                    Settings</a></li>
            <li><a href="blog-details.html"><i class="fa fa-credit-card" aria-hidden="true"></i>
                    Buy credits<span class="badge badge-info">( 10 credits)</span></a></li>
            <li><a href="blog-details.html"><i class="fa fa-list-alt" aria-hidden="true"></i></i>
                    Properties </a></li>
            <li><a href="blog-details.html"><i class="fa fa-indent" aria-hidden="true"></i> Add a
                    Property </a></li>
            <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Change
                    Password
                </a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                        {{ __('Log Out') }}
                    </x-link>
                </form>
            </li>
        </ul>
    </div>
</div>
