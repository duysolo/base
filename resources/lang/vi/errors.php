<?php

return [
    \Constants::METHOD_NOT_ALLOWED => [
        'title' => 'Phương thức truy cập không hợp lệ',
        'message' => 'Quay lại đi',
    ],
    \Constants::UNAUTHORIZED_CODE => [
        'title' => 'Yêu cầu truy cập bị từ chối',
        'message' => 'Yêu cầu không được áp dụng do thiếu chứng chỉ xác nhận hợp lệ',
    ],
    \Constants::FORBIDDEN_CODE => [
        'title' => 'Vùng cấm truy cập',
        'message' => 'Bạn không đủ quyền hạn để truy cập vào vùng này'
    ],
    \Constants::NOT_FOUND_CODE => [
        'title' => 'Không tìm thấy',
        'message' => 'Trang bạn yêu cầu không tồn tại'
    ],
    \Constants::ERROR_CODE => [
        'title' => 'Lỗi hệ thống',
        'message' => 'Có một vài lỗi xày ra trong quá trình thực hiện yêu cầu. Xem lại bản ghi hệ thống để biết rõ hơn',
    ],
    \Constants::MAINTENANCE_MODE => [
        'title' => 'Chế độ bảo trì',
        'message' => 'Ứng dụng đang ở chế độ bảo trì. Chúng tôi sẽ quay lại ngay sau đó',
    ],
];