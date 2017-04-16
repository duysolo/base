<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center bottom-separator">
            <img src="themes/triangle/images/home/under.png" class="img-responsive inline" alt="">
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="testimonial bottom">
                <h2>Testimonial</h2>
                @foreach($testimonials as $testimonial)
                    <div class="media">
                        <div class="pull-left">
                            <a href="{{ get_sub_field($testimonial, 'avatar') }}"
                               title="{{ get_sub_field($testimonial, 'client_name') }}">
                                <img src="{{ get_sub_field($testimonial, 'avatar') }}"
                                     alt="{{ get_sub_field($testimonial, 'client_name') }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <blockquote>
                                {{ get_sub_field($testimonial, 'description') }}
                            </blockquote>
                            <h3>
                                <a href="{{ get_sub_field($testimonial, 'avatar') }}">- {{ get_sub_field($testimonial, 'client_name') }}</a>
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="contact-info bottom">
                <h2>Contacts</h2>
                <address>{!! $contacts !!}</address>

                <h2>Address</h2>
                <address>{!! $address !!}</address>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="contact-form bottom">
                <h2>Send a message</h2>
                <form id="main-contact-form" name="contact-form" method="POST" action="{{ contact_form_url() }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="title" value="Client message">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" required="required"
                               placeholder="Email">
                    </div>
                    <div class="form-group">
                        <textarea name="content"
                                  id="message"
                                  required="required"
                                  class="form-control"
                                  rows="8"
                                  placeholder="Place your content here"></textarea>
                    </div>
                    <div class="form-group">
                        <div id="contactFormRecaptcha"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="copyright-text text-center">
                <p>&copy; WebEd CMS 2016 ~ {{ date('Y') }}. All Rights Reserved.</p>
                <p>Designed by <a target="_blank" href="http://designscrazed.org/">Allie</a></p>
            </div>
        </div>
    </div>
</div>