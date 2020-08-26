#11

adjusted css in admin login


=============================================

2020/08/25 #18

1. added admin forgot password
2. minor change to admin dashboard

#19
1. added popup alert in dashboard
2. adjusted how the alert in dashboard pop out

#20
1. updated logout function in _admin.function.php (since i dont want to create too much file)

=====================================

2020/08/26 #21
1. fully functional logout
2. NOTE: the reason you are not able to clear session is because you set $_SESSION['cus_row'] but you call $_SESSION['cus_id']