<a href="#" class="navbar-link" data-submit="#logout-form">
    <i class="fas fa-sign-out-alt"></i>
    @lang('common.logout')
</a>

{{ Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'logout-form', 'style' => 'display: none;']) }}
{{ Form::close() }}
