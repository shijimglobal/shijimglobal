<p>
    Shijim Global LLC ("we", "us") respects the privacy of visitors to <a href="{{ route('home') }}">{{ parse_url(route('home'), PHP_URL_HOST) }}</a> (the "site").
    This policy explains what information we collect, how we use and store it, and what rights you have.
</p>

<h2>1. Information we collect</h2>
<h3>Information you give us</h3>
<p>When you send a request through the contact form:</p>
<ul>
    <li>your name;</li>
    <li>your phone number;</li>
    <li>your email address (optional);</li>
    <li>the service you are interested in and your message.</li>
</ul>

<h3>Information collected automatically</h3>
<ul>
    <li><strong>Session cookie</strong> — keeps the site working, protects forms (CSRF protection) and remembers your chosen language.</li>
    <li><strong>Browser preference</strong> — your light/dark mode choice is stored in your own browser (localStorage) and is never sent to us.</li>
    <li><strong>IP address</strong> — used temporarily to protect against spam and excessive requests, and may appear in technical server logs.</li>
</ul>
<p>We do not use advertising or tracking cookies.</p>

<h2>2. How we use the information</h2>
<ul>
    <li>to respond to your request and send quotes or advice;</li>
    <li>to enter into and perform service agreements;</li>
    <li>to keep the site secure and running properly.</li>
</ul>
<p>We <strong>do not sell or rent</strong> your personal information or share it with third parties for advertising.</p>

<h2>3. Storage and security</h2>
<p>
    Contact form submissions are stored in our server database and can only be accessed by authorised staff through a password-protected admin panel.
    The site is served over encrypted HTTPS. We keep the information for as long as needed to handle your request and for business records, and delete it on request.
</p>

<h2>4. Third-party services</h2>
<ul>
    <li><strong>Google Fonts</strong> — the site's fonts are loaded from Google's servers, so your IP address is visible to Google.</li>
    <li><strong>Facebook (Meta)</strong> — the site shows public information from our Facebook page (name, pictures, follower count). Facebook images are loaded from Meta's servers. When you click a Facebook or Messenger link, <a href="https://www.facebook.com/privacy/policy" target="_blank" rel="noopener">Meta's privacy policy</a> applies.</li>
</ul>
<p>We do not use Facebook Login and do not collect information from your Facebook account.</p>

<h2>5. Your rights</h2>
<p>You have the right to:</p>
<ul>
    <li>ask what information we hold about you;</li>
    <li>have inaccurate information corrected;</li>
    <li>have your information deleted (see the <a href="{{ route('legal.data-deletion') }}">data deletion instructions</a>).</li>
</ul>

<h2>6. Changes</h2>
<p>We may update this policy when needed. The date of the latest update is shown at the top of this page.</p>

<h2>7. Contact</h2>
<p>
    If you have any questions about privacy, contact us:<br>
    Email: <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a><br>
    Phone: <a href="tel:{{ str_replace(' ', '', $company['phone']) }}">{{ $company['phone'] }}</a>
</p>
