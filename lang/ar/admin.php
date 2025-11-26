<?php

return [
    // General Navigation
    'navigation' => [
        'cars_management' => 'إدارة السيارات',
        'management'      => 'الإدارة',
        'media'           => 'الوسائط',
    ],

    // Model Labels
    'models' => [
        'car' => [
            'label'          => 'سيارة',
            'plural_label'   => 'السيارات',
            'navigation_label' => 'السيارات',
        ],
        'brand' => [
            'label'          => 'علامة تجارية',
            'plural_label'   => 'العلامات التجارية',
            'navigation_label' => 'العلامات التجارية',
        ],
        'gallery_item' => [
            'label'          => 'عنصر معرض',
            'plural_label'   => 'عناصر المعرض',
            'navigation_label' => 'الصور',
        ],
        'location' => [
            'label'          => 'موقع', 
            'plural_label'   => 'المواقع', 
            'navigation_label' => 'المواقع',
        ],
        'reservation' => [
            'label'          => 'حجز', 
            'plural_label'   => 'الحجوزات', 
            'navigation_label' => 'الحجوزات',
        ],
        'user' => [
            'label'          => 'مستخدم',
            'plural_label'   => 'المستخدمون',
            'navigation_label' => 'المستخدمون',
        ],
        'video' => [
            'label'          => 'فيديو',
            'plural_label'   => 'الفيديوهات',
            'navigation_label' => 'الفيديوهات',
        ],
    ],

    // Section Headings & Descriptions
    'sections' => [
        'car' => [
            'basic_info'      => 'المعلومات الأساسية',
            'basic_info_desc' => 'تفاصيل عامة عن السيارة.',
            'specifications'  => 'المواصفات',
            'pricing'         => 'التسعير',
            'media'           => 'الوسائط',
            'description'     => 'الوصف (متعدد اللغات)',
        ],
        'user' => [
            'user_info'      => 'معلومات المستخدم',
            'user_info_desc' => 'تفاصيل أساسية لهذا المستخدم.',
            'auth'           => 'المصادقة',
            'auth_desc'      => 'إدارة بيانات تسجيل الدخول والأدوار.',
        ],
    ],

    // Form Fields (Labels, Placeholders, Helpers)
    'form' => [
        // General
        'name'        => 'الاسم',
        'email'       => 'البريد الإلكتروني',
        'phone'       => 'رقم الهاتف',
        'title'       => 'العنوان',
        'description' => 'الوصف',

        // Car & Brand
        'brand'               => 'العلامة التجارية',
        'brand_name'          => 'اسم العلامة التجارية',
        'logo'                => 'الشعار',
        'category'            => 'الفئة',
        'location'            => 'الموقع',
        'fuel_type'           => 'نوع الوقود',
        'transmission'        => 'ناقل الحركة',
        'seats'               => 'المقاعد',
        'doors'               => 'الأبواب',
        'quantity'            => 'الكمية الإجمالية',
        'quantity_helper'     => 'كم عدد السيارات المتاحة من هذا الموديل بالضبط؟',
        'is_available'        => 'متاحة للإيجار',
        'is_available_helper' => 'مفتاح تحكم لإخفاء/إظهار هذه السيارة بالكامل.',
        'price_per_day'       => 'السعر لكل يوم',
        'driver_price_per_day'=> 'سعر السائق في اليوم', // Added
        'images'              => 'صور السيارة',
        'images_helper'       => 'قم برفع 5 صور كحد أقصى للسيارة',
        'desc_en'             => 'الوصف (الإنجليزية)',
        'desc_en_placeholder' => 'الوصف، الميزات، أو ملاحظات بالإنجليزية...',
        'desc_ar'             => 'الوصف (العربية)',
        'desc_ar_placeholder' => 'الوصف، الميزات، أو ملاحظات بالعربية...',

        // Gallery
        'image'     => 'الصورة',
        'alt_text'  => 'النص البديل',

        // Location
        'google_maps_link' => 'رابط خرائط جوجل',
        'google_maps_embed' => 'تضمين خرائط جوجل',
        'google_maps_embed_placeholder' => 'ألصق كود تضمين خرائط جوجل أو رابط التضمين هنا...',

        // Reservation
        'user'                 => 'المستخدم',
        'car'                  => 'السيارة',
        'with_driver'          => 'مع سائق', // Added
        'pickup_location'      => 'موقع الاستلام',
        'dropoff_location'     => 'موقع التسليم',
        'start_datetime'       => 'تاريخ ووقت البدء',
        'end_datetime'         => 'تاريخ ووقت الانتهاء',
        'total_price'          => 'السعر الإجمالي',
        'total_price_helper'   => 'يُحسب تلقائيًا عند الحفظ',
        'status'               => 'الحالة',

        // User
        'government_id'       => 'رقم الهوية/الإقامة',
        'new_password'        => 'كلمة المرور الجديدة',
        'new_password_in_form'=> 'كلمة المرور الجديدة',
        'new_password_helper' => 'اتركه فارغًا للإبقاء على كلمة المرور الحالية.',
        'is_admin'            => 'مدير نظام',
        'is_admin_helper'     => 'يمنح الوصول إلى لوحة التحكم.',

        // Video
        'video_path'           => 'ملف الفيديو أو الرابط',
        'thumbnail'            => 'الصورة المصغرة',
        'is_active_slideshow'  => 'نشط في عرض الشرائح',
        'order'                => 'ترتيب العرض',

        // Form Select Options
        'options' => [
            'categories' => [
                'sedan'        => 'سيدان',
                'suv'          => 'SUV (دفع رباعي)',
                'sports_car'   => 'سيارة رياضية',
                'hatchback'    => 'هاتشباك',
                'coupe'        => 'كوبيه',
                'convertible'  => 'سيارة مكشوفة',
                'pickup_truck' => 'شاحنة بيك أب',
                'van'          => 'فان',
            ],
            'fuel_types' => [
                'petrol'   => 'بنزين',
                'diesel'   => 'ديزل',
                'electric' => 'كهربائية',
                'hybrid'   => 'هجينة',
            ],
            'transmissions' => [
                'manual'         => 'يدوي',
                'automatic'      => 'أوتوماتيك',
                'semi-automatic' => 'شبه أوتوماتيك',
            ],
            'status' => [
                'pending'   => 'قيد الانتظار',
                'confirmed' => 'مؤكد',
                'completed' => 'مكتمل',
                'canceled'  => 'ملغى',
                'overdue'   => 'متأخر',
            ],
        ],
    ],

    // Table Columns
    'table' => [
        // General
        'name'        => 'الاسم',
        'active'      => 'نشط',
        'created_at'  => 'تاريخ الإنشاء',
        'order'       => 'الترتيب',

        // Car & Brand
        'brand'         => 'العلامة التجارية',
        'brand_name'    => 'اسم العلامة التجارية',
        'logo'          => 'الشعار',
        'quantity_short'=> 'الكمية',
        'category'      => 'الفئة',
        'price_per_day' => 'السعر/يوم',
        'location'      => 'الموقع',
        'cars_count'    => 'عدد السيارات',

        // Gallery
        'image'    => 'الصورة',
        'alt_text' => 'النص البديل',
        
        // Location
        'google_maps' => 'خرائط جوجل',
        'google_maps_embed' => 'تضمين خرائط جوجل',

        // Reservation
        'user'        => 'المستخدم',
        'car'         => 'السيارة',
        'pickup'      => 'الاستلام',
        'dropoff'     => 'التسليم',
        'start'       => 'البداية',
        'end'         => 'النهاية',
        'total_price' => 'السعر الإجمالي',
        'status'      => 'الحالة',
        'with_driver' => 'مع سائق', // Added
        
        // User
        'email'   => 'البريد الإلكتروني',
        'phone'   => 'الهاتف',
        'gov_id'  => 'رقم الهوية',
        'admin'   => 'مدير',

        // Video
        'preview'    => 'معاينة',
        'title'      => 'العنوان',
        'video_path' => 'مسار الفيديو',
    ],

    // Table Filters
    'filters' => [
        'availability' => 'مفتاح التحكم بالتوافر',
    ],

    // Table Actions
    'table_actions' => [
        'whatsapp'         => 'واتساب',
        'whatsapp_tooltip' => 'مراسلة العميل على واتساب',
        'reset_password'   => 'إعادة تعيين كلمة المرور',
    ],

    // Notifications
    'notifications' => [
        'password_reset_success' => 'تمت إعادة تعيين كلمة المرور بنجاح!',
    ],
];