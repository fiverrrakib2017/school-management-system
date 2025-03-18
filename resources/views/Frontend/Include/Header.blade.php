
<div id="header" class="container">
    <div class="row">
        <!-- Logo -->
        <div class="logo">
            <a href="{{ url('/') }}" title="">
                @if($website_info->logo)
                    <img class="img-fluid" src="{{ asset('Backend/uploads/photos/' . $website_info->logo) }}" alt="website logo" height="90px" width="90px">
                @else
                    <img src="https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg" alt="default avatar">
                @endif
            </a>
        </div>

        <!-- End Logo -->
        <!-- Start Social link -->
        <ul class="social-icons pull-right hidden-xs">
            <li class="social-facebook">
                <a href="https://www.facebook.com/" target="_blank" title="Facebook"></a>
            </li>
            <li class="social-twitter">
                <a href="https://twitter.com" target="_blank" title="Twitter"></a>
            </li>
            <li class="social-googleplus">
                <a href="https://plus.google.com" target="_blank" title="Googleplus"></a>
            </li>
            <li class="social-linkedin">
                <a href="https://www.linkedin.com/" target="_blank" title="Linkedin"></a>
            </li>
            <li class="social-youtube">
                <a href="https://www.youtube.com/" target="_blank" title="Youtube"></a>
            </li>
        </ul>
    </div>
</div>
