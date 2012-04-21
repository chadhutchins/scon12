<?php

/******************************************************************************
Copyright (C) 2012 by Chad Hutchins

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
******************************************************************************/

// sugarcrm username and password that will be used to
// connect to sugarcrm via the web services
$username = "admin";
$password = "password";

// url to sugarcrm web services 
$web_services_url = "http://sugarce650.dev/service/v4_1/rest.php";

// the url you would like the user to be redirected to
// after completing the form
$redirect_url = "http://chadhutchins.dev/sugarcon/thankyou";

// the name of the module you'll be adding the form data to
$module_name = "srvy_scon12";

// the form fields you want to attempt to gather data from
// within the form and pass to sugar. for example, if you 
// have a field on the module named 'email' and the input name of
// the html element is named 'emailaddress' your array would look
// like the following:
// array(
//     "email" => "emailaddress"
// )
$available_fields = array(
    "name" => "name",
    "question1" => "question1",
    "question2" => "question2",
    "question3" => "question3"
);

require_once('sugar_rest.php');
$sugar = new Sugar_REST($web_services_url,$username,$password);

// loop through each available field and get value from form data
$name_value_list = array();
foreach($available_fields as $sugarfield => $formfield)
{
    $name_value_list []= array(
        "name" => $sugarfield,
        "value" => $_REQUEST[$formfield]
    );
}

// add form information to SugarCRM
$result = $sugar->set($module_name,$name_value_list);

// Redirect
header('Location: '.$redirect_url);

?>