# WDT-Assignment
Food Delivery System (Website)

##  TO NOTE THAT
THE FILE IS READ ONLY


<b>From: heiguy123</b><br>
1. Add encryted password function.<br>
2. Fixing minor bugs.<br>
3. sql `customer` update table.<br>

<h4>Date: 2020/09/02</h4>
<b>From: heiguy123</b><br>
1. Remove social links to register (too mafan).<br>

<h4>Date: 2020/09/02</h4>
<b>From: heiguy123</b><br>
1. Fixing minor bugs.<br>

<h4>Date: 2020/09/01</h4>
<b>From: heiguy123</b><br>
1. Add function in order.php (request_cancel)<br>
2. Delete unnecessary files. <br>
3. Add function in account.php (account_setting) <br>
4. Add help.php<br>
5. Fixing minor bugs.<br>

<h4>Date: 2020/08/31</h4>
<b>From: heiguy123</b><br>
1. Add payment.php<br>
2. Add cus_payment.php<br>
3. Add payment.scss <br>
4. Add verify_payment.scss <br>
5. Add receipt.php <br>
6. Add order.php (prototype) <br>
7. Updates functionality from checkout to track order. <br>
8. Modify foodordering.sql (Add `cus_id` in `payment`)<br>
9. Update _cus.function.php<br>
10. Update cart.php<br>
11. Update cus_check.php (Add $_SESSION['street_name'],$_SESSION['city'],$_SESSION['postcode'])<br>
----------------------------------------------------<br>
12. Fix UI bugs.<br>
13. Validate postcode with the record in database [Functionality]<br>
14. Disable checkout button if there is no food item in cart [Functionality]<br>
15. Inherit order function from admin to customer. TQ HOWARD FOR CONTRIBUTION <br>

<h4>Date: 2020/08/30</h4>
<b>From: heiguy123</b><br>
1. Updates dashboard.php functionality.<br>
2. To note the block keep showing if there is no add in database for that customer when he try to add food item. Eg. customer3<br>
3. Add $_SESSION['cus_row']['address'] <br>
4. Add google autocomplete address api. Include this link in the page where wish to use this.<br>
<**script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjfNwSIkZCl8DtDcjKlhSq_CUZLEtteSg&libraries=places"></**script><br>
API Key = AIzaSyAjfNwSIkZCl8DtDcjKlhSq_CUZLEtteSg<br>
5. Update search bar [DONE]<br>
6. Note: use the cus_dashboard, kindly <br>
        a. provide cus_add (make sure postcode(1st) city(2nd))<br>
        b. add food item<br>
        c. check cart in button 'more detail'<br>
7. Fixing minor bugs. <br>


<h4>Date: 2020/08/29</h4>
<b>From: heiguy123</b><br>
1. Major updates in dashboard.php (Functionality)<br>
2. Fixing bugs in cus_check.php<br>
3. Add cart.php<br>
4. Add function(s) into _cus.function.php<br>
5. Add cart.scss <br>
6. Improve dashboard.scss <br>
7. Add file ref<br>
----------------------------------------------------<br>
8. Fix bugs in addCart() in dashboard.php<br>
9. Fix minor bugs.<br>

<h4>Date: 2020/08/28</h4>
<b>From: heiguy123</b><br>
1. Change BLOB file size in food/picture in .sql<br>
2. Improve dashboard.php functionality.<br>
3. Merge functions into _cus.function.php<br>
4. Remove cus_register.php<br>
5. Remove cus_forgot.php <br>

<h4>Date: 2020/08/25</h4>
<b>From: heiguy123</b><br>
1. Add phpmailer wrapper in cus_register.php (To send email from smtp server to <b>SMTP SERVER</b>).To note that please turn off the two-step authotification and allow lower apps.<br>
2. Update verification.php UI<br>
3. Add verification.scss<br>
4. Add cus_register_form.php<br>
5. Update cus_register.php<br>
6. add register_form.scss<br>
7. <b>Note: The length of email in MySQL should changed to 30 (both customer and admin).</b><br>
8. <b>Note: The .sql file haven't update the above changes.</b><br>
9. Create Gmail for myrestaurant:<br>
Email: wdtmyrestaurant2020@gmail.com<br>
Password: WDTmyrestaurant@2020<br><br>
----------------------------------------------------<br>
10. Update reset_pasword.php UI<br>
11. Add cus_rest_password.php<br>
12. Update forgot.php UI <br>
13. Note: The forgot.php and reset_password.php is using register.scss and register_form.scss<br>
14. Note: Both register.php and forgot.php will link to verification.php<br>
15. Update term.php UI<br>
----------------------------------------------------<br>
16. Add _cus.function.php<br>
17. Add logout.php. To note 'session_destroy()' and '$_SESSION = arr()'<br>
18. Note: term.php is using index.scss<br>
19. Fix minor bugs.<br>

<h4>Date: 2020/08/23</h4>
<b>From: heiguy123</b><br>
1. Fully functionable register.php<br>
2. Add cus_check.php, cus_register.php<br>

<h4>Date: 2020/08/22</h4>
<b>From: heiguy123</b><br>
1. Fully functionable index.php<br>
2. Add reset_password.php<br>
3. Add term.php<br>
4. Add index.scss<br>
5. Note: Include those when watching sass (to prevent sass compile the .scss in font-awsome file)<br>
<br>"liveSassCompile.settings.excludeList": [
        "**/node_modules/**",
        ".vscode/**",
        <b>"**/bootstrap-4.5.0/**",</b>
        <b>"**/fontawesome-free-5.14.0-web/**"</b>
]<br><br>
6. Remove unnessary img from /img folder.<br>
7. You might require to @import "_nav.scss" + "_footer.scss" when doing new .scss file.<br>
------------------------------------------------------------------------------------<br>
8. Small update on footer.<br>
9. Note: This line could delete it in the head of the html. <br><br>
<,script src="./fontawesome-free-5.14.0-web/js/all.js"></,script><br><br>
10. Fully functionable login.php. <b>REMEMBER ME HAVENT DO</b><br>

<br>

<h4>Date: 2020/08/18</h4>
<b>From: heiguy123</b><br>
1. Currently are using html with external css + internal css (abit) in this website.<br>
2. The login.css used in most of the likely html... Seems have to separate them but dunno will increase the redundancy.<br>
3. Most of the pages used navigation + footer (all pages XD), which think to separate them and reuse it...<br>
4. The php file is empty so far...
