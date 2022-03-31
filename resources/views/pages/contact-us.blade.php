@extends("layouts.app")
@section("title", "Contactez-nous")

@section("content")
    <x-breadcrumbs :levels="[(object) array('label' => 'Contactez-nous')]"/>
    <!--contact map start-->
    <div class="contact_map">
        <div class="map-area">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12834.874772477595!2d10.80265!3d36.464354!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc4737f19d61dca0!2sIDEAL%20INFORMATIQUE!5e0!3m2!1sfr!2stn!4v1648752068234!5m2!1sfr!2stn"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!--contact map end-->

    <!--contact area start-->
    <div class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3>contact us</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                            est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                            formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Address : Your address goes here.</li>
                            <li><i class="fa fa-envelope-o"> </i> Email: <a
                                    href="mailto:demo@example.com">demo@example.com </a>
                            </li>
                            <li><i class="fa fa-phone"></i> Phone:<a href="tel: 0123456789"> 0123456789 </a></li>
                        </ul>
                        >
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message form">
                        <h3>Tell us your project</h3>
                        <form id="contact-form" method="POST"
                              action="https://template.hasthemes.com/junko/junko/assets/mail.php">
                            <p>
                                <label> Your Name (required)</label>
                                <input name="name" placeholder="Name *" type="text">
                            </p>
                            <p>
                                <label> Your Email (required)</label>
                                <input name="email" placeholder="Email *" type="email">
                            </p>
                            <p>
                                <label> Subject</label>
                                <input name="subject" placeholder="Subject *" type="text">
                            </p>
                            <div class="contact_textarea">
                                <label> Your Message</label>
                                <textarea placeholder="Message *" name="message" class="form-control2"></textarea>
                            </div>
                            <button type="submit"> Send</button>
                            <p class="form-messege"></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact area end-->
@endsection
@push("scripts")
@endpush
