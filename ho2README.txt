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

#22
1. minor update on admin dashboard
2. updated sql
    STRUCTURE:
    1. REMOVED 'cart_id' reference from ORDER table
    2. ADDED 'total' for CART TABLE  
    3. CHANGED 'subtotal' data type from INT to DECIMAL 
    4. ADDED PAYMENT_METHOD table
    5. ADDED 'add_id' for ORDER table

    RECORD ADDED:
    - CART: 2 records
    - CART_DETAIL: 3 records
    - ORDER: 7 records 
    - ORDER_DETAIL: 9 records
    - ORDER_CANCEL_REQUEST: 3 records 
    - PAYMENT_METHOD: 2 records
    - DELIVERY_TASK: 3 records 
    
    RECORD UPDATED:
    - RIDER with id 1 become STATUS: Out for delivery
     
#23
1. completed admin dashboard