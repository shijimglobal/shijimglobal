<p>
    These terms apply to the use of the Shijim Global LLC ("we", "us") website at <a href="{{ route('home') }}">{{ parse_url(route('home'), PHP_URL_HOST) }}</a> (the "site").
    By using the site you agree to these terms.
</p>

<h2>1. Purpose of the site</h2>
<p>
    The site provides information about our services (company websites, online payments, e-commerce, server setup and server rental) and accepts enquiries.
    Information on the site is a general introduction and not a formal offer.
</p>

<h2>2. Services and agreements</h2>
<p>
    The scope, price, timeline, payment terms and warranties of any service are agreed in a separate contract between the parties.
    If that contract conflicts with these terms, the contract prevails.
</p>

<h2>3. Your obligations</h2>
<ul>
    <li>provide accurate information in the contact form;</li>
    <li>do not disrupt the site or attempt unauthorised access;</li>
    <li>do not send spam or unlawful content through the site.</li>
</ul>

<h2>4. Intellectual property</h2>
<p>
    The design, logo, text, images and other content of the site belong to Shijim Global LLC and may not be copied, distributed or used commercially without our written permission.
    Partner logos belong to their respective owners.
</p>

<h2>5. Third-party links</h2>
<p>The site may link to Facebook, Messenger and partner websites. We are not responsible for their content or privacy practices.</p>

<h2>6. Limitation of liability</h2>
<p>
    We strive to keep the site available and error-free but cannot guarantee uninterrupted operation.
    We are not liable for losses arising from decisions made solely on the basis of general information on the site.
</p>

<h2>7. Personal information</h2>
<p>How we use your personal information is explained in our <a href="{{ route('legal.privacy') }}">Privacy Policy</a>.</p>

<h2>8. Changes and governing law</h2>
<p>We may update these terms when needed. These terms are governed by the laws of Mongolia.</p>

<h2>9. Contact</h2>
<p>
    Email: <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a><br>
    Phone: <a href="tel:{{ str_replace(' ', '', $company['phone']) }}">{{ $company['phone'] }}</a>
</p>
