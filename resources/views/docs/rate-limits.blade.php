<p>Rate limits are determined globally for the entire API. Each API key is limited to {{ App\RateLimiter::DAILY_LIMIT }} requests per day.</p>

<p>If you hit the rate limit, you will receive an <a href="#errors-rate-limit">HTTP 429</a> error.</p>
