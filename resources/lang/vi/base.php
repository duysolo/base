<?php

return [
    'add_new' => 'Thêm mới',
    'admin_menu' => [
        'dashboard' => [
            'heading' => 'Bảng điều khiển',
            'title' => 'Bảng điều khiển',
        ],
        'configuration' => [
            'heading' => 'Nâng cao',
            'title' => 'Cấu hình',
        ],
    ],
    'form' => [
        'create' => 'Thêm',
        'edit' => 'Sửa',
        'disable' => 'Vô hiệu hóa',
        'delete' => 'Xóa',
        'submit' => 'Gửi đi',
        'save' => 'Lưu',
        'save_and_continue' => 'Lưu và tiếp tục',
        'save_change' => 'Lưu thay đổi',
        'select' => 'Chọn',
        'search' => 'Tìm kiếm',

        'basic_info' => 'Thông tin cơ bản',

        'choose_image' => 'Chọn hình',
        'choose_file' => 'Chọn tập tin',
        'choose_images' => 'Chọn nhiều hình',
        'choose_files' => 'Chọn nhiều tập tin',

        'title' => 'Tiêu đề',
        'slug' => 'Tên truy nhập',
        'content' => 'Nội dung',
        'keywords' => 'Từ khóa',
        'description' => 'Mô tả ngắn',
        'templates' => 'Mẫu giao diện',
        'thumbnail' => 'Hình đại diện',
        'order' => 'Sắp xếp',
        'status' => 'Hiện trạng',
        'sex' => 'Giới tính',
        'is_featured' => 'Là nổi bật',
        'publish' => 'Xuất bản',

        'model_not_exists' => 'Dữ liệu không tồn tại với id:',
        'item_not_exists' => 'Đối tượng không tồn tại',
        'request_completed' => 'Yêu cầu đã được thực hiện thành công',
        'error_occurred' => 'Có lỗi xảy ra trong lúc thực hiện yêu cầu',
    ],
    'setting_group' => [
        'basic' => 'Cơ bản',
        'advanced' => 'Nâng cao',
        'socials' => 'Mạng xã hội',
    ],
    'settings' => [
        'site_title' => [
            'label' => 'Tiêu đề trang',
            'helper' => 'Tiêu đề trang sẽ giúp khách hàng dễ nhớ tới ứng dụng của chúng ta'
        ],
        'app_name' => [
            'label' => 'Tên ứng dụng',
            'helper' => 'Tên của ứng dụng hiện tại',
        ],
        'site_logo' => [
            'label' => 'Ảnh đại diện',
            'helper' => 'Thêm ảnh đại diện. Ảnh này sẽ được dùng cho mục đích SEO'
        ],
        'favicon' => [
            'label' => 'Favicon',
            'helper' => 'Kích thước 16x16, hộ trợ các tập tin png, gif, ico, jpg'
        ],
        'construction_mode' => [
            'label' => 'Chế độ bảo trì',
            'helper' => 'Thiết lập trang web ở chế độ bảo trì. Chỉ người quản trị có thể truy cập trang web',
        ],
        'show_admin_bar' => [
            'label' => 'Hiện thanh quản trị',
            'helper' => 'Hiện thanh quản trị ứng dụng khi admin truy cập ứng dụng'
        ],
        'socials' => [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'google_plus' => 'Google+',
            'youtube' => 'Youtube',
            'instagram' => 'Instagram',
            'linkedin' => 'Linkedin',
            'flickr' => 'Flickr',
        ],

        'smtp' => [
            'smtp_driver' => [
                'label' => 'SMTP driver',
                'helper' => 'WebEd hỗ trợ cả <b>SMTP</b> và hàm <b>mail</b> của PHP làm driver để gửi các thư điện tử. Ban có thể chỉ định driver nào bạn muốn sử dụng trong ứng dụng của bạn tại đây. Mặc định, WebEd được cài đặt với giao thức <b>SMTP</b>.',
            ],
            'smtp_host' => [
                'label' => 'SMTP host',
                'helper' => 'Bạn cần cung cấp địa chỉ hosting máy chủ SMTP được sử dụng bởi ứng dụng.',
            ],
            'smtp_port' => [
                'label' => 'SMTP port',
                'helper' => 'Đây là cổng giao thức SMTP được sử dụng bởi ứng dụng để gửi thư điện tử tới người dùng.',
            ],
            'smtp_encryption' => [
                'label' => 'E-Mail encryption protocol',
                'helper' => 'Tại đây bạn có thể chỉ định giao thức mã hóa phù hợp khi ứng dụng gửi thư điện tử.',
            ],
            'smtp_from_address' => [
                'label' => 'Global "From" address',
                'helper' => 'Có thể bạn muốn tất cả các thư điện tử được gửi bởi ứng dụng sẽ được gửi từ cùng một địa chỉ. Tại đây bạn có thể chỉ định địa chỉ thư điện tử mặc định.',
            ],
            'smtp_from_name' => [
                'label' => 'Global "From" name',
                'helper' => 'Có thể bạn muốn tất cả các thư điện tử được gửi bởi ứng dụng sẽ được gửi từ cùng một địa chỉ. Tại đây bạn có thể chỉ định tên mặc định.',
            ],
            'smtp_username' => [
                'label' => 'SMTP server username',
                'helper' => 'Nếu máy chủ SMTP của bạn yêu cầu xác thực, bạn cần thiết lập nó ở đây.',
            ],
            'smtp_password' => [
                'label' => 'SMTP server password',
                'helper' => 'Nếu máy chủ SMTP của bạn yêu cầu xác thực, bạn cần thiết lập nó ở đây.',
            ],
        ],
    ],
    'status' => [
        'disabled' => 'Đã vô hiệu hóa',
        'activated' => 'Đã kích hoạt',
        'deleted' => 'Đã xóa',
    ],
    'sex' => [
        'male' => 'Nam',
        'female' => 'Nữ',
        'other' => 'Khác',
    ],
    'version' => 'Phiên bản',
    'visit_page' => 'Ghé trang',
    'stat_box' => [
        'more_info' => 'Thông tin thêm',
    ],

    'item_not_exists' => 'Mục này không tồn tại',
    'disabled_in_demo_mode' => 'Chức tạm tạm thời bị khóa trên trang demo',
];
