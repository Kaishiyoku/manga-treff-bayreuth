{{ html()->form('delete', $route)->class('inline')->open() }}
    {{ html()->button($title ?? __('common.delete'), 'submit')->attributes(['class' => (!empty($class) ? $class : 'btn btn-sm btn-danger'), 'data-confirm' => '']) }}
{{ html()->form()->close() }}
