<p>
    You can ask us to delete the personal information you sent through our website's contact form (name, phone, email and message) at any time.
</p>

<h2>How to request deletion</h2>
<ol>
    <li>
        Send an email to <a href="mailto:{{ $company['email'] }}?subject={{ rawurlencode('Data deletion request') }}">{{ $company['email'] }}</a>
        with the subject <strong>"Data deletion request"</strong>.
    </li>
    <li>Include the <strong>name and phone number</strong> you used in the form so we can find your request.</li>
    <li>We will permanently delete your information from our database and let you know.</li>
</ol>
<p>You can also call us at <a href="tel:{{ str_replace(' ', '', $company['phone']) }}">{{ $company['phone'] }}</a>.</p>

<h2>Facebook-related data</h2>
<p>
    Our site does not use Facebook Login and does not collect or store information from your Facebook account.
    The site only displays public information from our own Facebook page (such as the follower count).
</p>
<p>
    To delete messages you exchanged with us on Messenger, delete the conversation in the Messenger app or contact the
    <a href="https://www.facebook.com/help/contact/" target="_blank" rel="noopener">Facebook Help Center</a>.
</p>

<h2>Data stored in your browser</h2>
<p>Your dark mode and language preferences are stored in your browser. Clearing your browser's cookies and site data removes them.</p>

<p>See our <a href="{{ route('legal.privacy') }}">Privacy Policy</a> for more details.</p>
