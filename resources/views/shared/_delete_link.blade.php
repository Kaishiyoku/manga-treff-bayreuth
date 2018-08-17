{{ Form::open(['route' => $route, 'method' => 'delete', 'role' => 'form', 'class' => 'inline']) }}
    {{ Form::button(__('common.delete'), ['type' => 'submit', 'class' => (!empty($class) ? $class : 'btn btn-link btn-delete'), 'data-confirm' => '']) }}
{{ Form::close() }}