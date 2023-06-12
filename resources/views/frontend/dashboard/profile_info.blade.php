<div class="sidebar-widget post-widget">
    <div class="widget-title">
        <h4>User Profile </h4>
    </div>
    <div class="post-inner">
        <div class="post">
            <figure class="post-thumb">
                <a href="#">
                    <img src="{{ !empty(Auth::user()->photo) ? asset(Auth::user()->photo) : url('upload/no_image.jpg') }}"
                        alt=""></a>
            </figure>
            <h5><a href="#">{{ Auth::user()->name }} </a></h5>
            <p>{{ Auth::user()->email }} </p>
        </div>
    </div>
</div>
