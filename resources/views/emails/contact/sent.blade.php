@section('title', trans('home.emails.contact.title'))

@lang('validation.attributes.fullname'): {{ $fullname }}
@lang('validation.attributes.email'): {{ $email }}

@lang('validation.attributes.content'):

{{ $content }}