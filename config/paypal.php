<?php
return [
	// Client ID của app mà bạn đã đăng ký trên PayPal Dev
    'client_id' => 'AT-nUyomrlYIcrr_Ett0sNjTWdzgGwz38ssfcIMt1sCTJA13_8ruhGNduYSKC5h6BIaddGbChUPCexGf',
    // Secret của app
    'secret' => 'EJXUn1CfXQrHaT837bws-JhG4zVbhai7tu7Efz3QbBpRDCGzZpSxn5RwJRBDVF9LgDeRXA0fNz9hEhPC',
    'settings' => [
        // Thời gian của một kết nối (tính bằng giây)
        'http.ConnectionTimeOut' => 30,
    	// PayPal mode, sanbox hoặc live
        'mode' => 'sandbox',  
        // Có ghi log khi xảy ra lỗi
        'log.logEnabled' => true,
        
        // Đường dẫn đền file sẽ ghi log
        'log.FileName' => storage_path() . '/logs/paypal.php',
        // Kiểu log
        'log.LogLevel' => 'INFO'
    ],
];