# WDT-Assignment
Food Delivery System (Website)

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
9. Create Gmail for myrestaurant:<br><br>
Email: wdtmyrestaurant2020@gmail.com<br>
Password: WDTmyrestaurant@2020<br>

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