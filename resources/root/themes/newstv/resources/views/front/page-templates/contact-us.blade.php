@extends('webed-theme::front._master')

@section('content')
    <div class="container">
        <div class="main-content">
            <div class="main-full">
                <div class="page-contact">
                    <div class="tn-ggmap">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                    src="{{ get_theme_option('visit_us_on_google_map') }}"></iframe>
                        </div>
                    </div>
                    <div class="contact-form">
                        <h2>{{ trans('webed-theme::contact.title') }}</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                {!! $object->content !!}
                            </div>
                            @if(webed_plugins()->isActivated('contact-forms'))
                                <div class="col-sm-6">
                                    <p>{{ trans('webed-theme::contact.form_title') }}</p>
                                    <form role="form"
                                          method="POST"
                                          accept-charset="UTF-8"
                                          action="{{ contact_form_url() }}">
                                        {!! csrf_field() !!}
                                        {!! contact_form_alias() !!}
                                        <div class="form-group">
                                            <label for="Email">{{ trans('webed-theme::contact.email_label') }}</label>
                                            <input type="email"
                                                   class="form-control"
                                                   id="Email"
                                                   placeholder="{{ trans('webed-theme::contact.email_placeholder') }}"
                                                   name="email"
                                                   required
                                                   value="{{ old('email') }}"
                                                   autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">{{ trans('webed-theme::contact.name_label') }}</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="Name"
                                                   placeholder="{{ trans('webed-theme::contact.name_placeholder') }}"
                                                   name="name"
                                                   required
                                                   value="{{ old('name') }}"
                                                   autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Title">{{ trans('webed-theme::contact.title_label') }}</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="Title"
                                                   placeholder="{{ trans('webed-theme::contact.title_placeholder') }}"
                                                   name="title"
                                                   required
                                                   value="{{ old('title') }}"
                                                   autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">{{ trans('webed-theme::contact.content_label') }}</label>
                                            <textarea class="form-control"
                                                      rows="5"
                                                      required
                                                      placeholder="{{ trans('webed-theme::contact.content_placeholder') }}"
                                                      name="content">{!! old('content') !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div id="contactFormRecaptcha"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            {{ trans('webed-theme::contact.submit') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
