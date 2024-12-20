<style>
    .bg-darkblue {
        background-color: #1B3A57; /* Dark Blue */
        color: white;
    }
</style>

<div class="navbar navbar-expand-lg bg-darkblue">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            More Links
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; {{ date('Y') }}. <a href="#" style="color: white;">{{ Qs::getSystemName() }}</a> by <a href="#" style="color: white;">Rangishuri</a>
        </span>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item"><a href="{{ route('privacy_policy') }}" class="navbar-nav-link" target="_blank" style="color: white;"><i class="icon-lifebuoy mr-2"></i> Privacy Policy</a></li>
            <li class="nav-item"><a href="{{ route('terms_of_use') }}" class="navbar-nav-link" target="_blank" style="color: white;"><i class="icon-file-text2 mr-2"></i> Terms of Use </a></li>
        </ul>
    </div>
</div>
