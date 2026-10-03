<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwToBareDomain
{
    /**
     * Permanently redirect "www." page requests to the bare domain so search engines index a single site.
     *
     * Only the site's own domain (from APP_URL) is redirected, and only GET/HEAD requests,
     * because a 301 would turn a submitted form (POST) into a GET and lose its data.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bareDomain = parse_url(config('app.url'), PHP_URL_HOST);

        $isWwwOfOurDomain = $bareDomain !== null && $request->getHost() === 'www.'.$bareDomain;

        if (! $isWwwOfOurDomain || ! $request->isMethodSafe()) {
            return $next($request);
        }

        return redirect()->to('https://'.$bareDomain.$request->getRequestUri(), 301);
    }
}
