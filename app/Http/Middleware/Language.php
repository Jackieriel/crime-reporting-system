<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        // get the subdomain if exists
        $urlArray = explode('.', parse_url($request->url(), PHP_URL_HOST));
        if (count($urlArray) < 3) {
            return $next($request);
        }
        $subdomain = $urlArray[0];



        // if it's the default language: redirect to URL without subdomain
        if ($subdomain == 'en') {

            $baseUrl = str_replace('//en.', '//', $request->url());
            return redirect()->to($baseUrl);
        }



        // if it's a valid language, set as locale and set time zone
        if (array_key_exists($subdomain, config()->get('app.locales'))) {

            \App::setLocale($subdomain);

            setlocale(LC_TIME, $subdomain);
        }


        return $next($request);
    }
}
