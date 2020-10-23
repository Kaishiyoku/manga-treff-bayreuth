<a href="#" class="navbar-link" data-submit="#logout-form">
    <i class="fas fa-sign-out-alt"></i>
    @lang('common.logout')
</a>

{{ html()->form('post', route('logout'))->attributes(['id' => 'logout-form', 'style' => 'display: none;']) }}
