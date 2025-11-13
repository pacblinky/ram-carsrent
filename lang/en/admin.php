<?php

return [
    // General Navigation
    'navigation' => [
        'cars_management' => 'Cars Management',
        'management'      => 'Management',
        'media'           => 'Media',
    ],

    // Model Labels (used in navigation, breadcrumbs, etc.)
    'models' => [
        'car' => [
            'label'          => 'Car',
            'plural_label'   => 'Cars',
            'navigation_label' => 'Cars',
        ],
        'brand' => [
            'label'          => 'Brand',
            'plural_label'   => 'Brands',
            'navigation_label' => 'Brands',
        ],
        'gallery_item' => [
            'label'          => 'Gallery Item',
            'plural_label'   => 'Gallery Items',
            'navigation_label' => 'Images',
        ],
        'location' => [
            'label'          => 'Location', // ADDED
            'plural_label'   => 'Locations', // ADDED
            'navigation_label' => 'Locations',
        ],
        'reservation' => [
            'label'          => 'Reservation', // ADDED
            'plural_label'   => 'Reservations', // ADDED
            'navigation_label' => 'Reservations',
        ],
        'user' => [
            'label'          => 'User',
            'plural_label'   => 'Users',
            'navigation_label' => 'Users',
        ],
        'video' => [
            'label'          => 'Video',
            'plural_label'   => 'Videos',
            'navigation_label' => 'Videos',
        ],
    ],

    // Section Headings & Descriptions
    'sections' => [
        'car' => [
            'basic_info'      => 'Basic Information',
            'basic_info_desc' => 'General details about the car.',
            'specifications'  => 'Specifications',
            'pricing'         => 'Pricing',
            'media'           => 'Media',
            'description'     => 'Description (Multilingual)',
        ],
        'user' => [
            'user_info'      => 'User Information',
            'user_info_desc' => 'Basic details for this user.',
            'auth'           => 'Authentication',
            'auth_desc'      => 'Manage login credentials and roles.',
        ],
    ],

    // Form Fields (Labels, Placeholders, Helpers)
    'form' => [
        // General
        'name'        => 'Name',
        'email'       => 'Email',
        'phone'       => 'Phone',
        'title'       => 'Title',
        'description' => 'Description',

        // Car & Brand
        'brand'               => 'Brand',
        'brand_name'          => 'Brand Name',
        'logo'                => 'Logo',
        'category'            => 'Category',
        'location'            => 'Location',
        'fuel_type'           => 'Fuel Type',
        'transmission'        => 'Transmission',
        'seats'               => 'Seats',
        'doors'               => 'Doors',
        'quantity'            => 'Total Quantity',
        'quantity_helper'     => 'How many of this exact car model are available?',
        'is_available'        => 'Available for Rent',
        'is_available_helper' => 'Master switch to hide/show this car entirely.',
        'price_per_day'       => 'Price per Day',
        'images'              => 'Car Images',
        'images_helper'       => 'Upload up to 5 images of the car',
        'desc_en'             => 'Description (English)',
        'desc_en_placeholder' => 'English description, features, or notes...',
        'desc_ar'             => 'Description (Arabic)',
        'desc_ar_placeholder' => 'Arabic description, features, or notes...',

        // Gallery
        'image'     => 'Image',
        'alt_text'  => 'Alt Text',

        // Location
        'google_maps_link' => 'Google Maps Link',
        'google_maps_embed' => 'Google Maps Embed',
        'google_maps_embed_placeholder' => 'Paste the Google Maps embed iframe or embed URL here...',

        // Reservation
        'user'                 => 'User',
        'car'                  => 'Car',
        'pickup_location'      => 'Pickup Location',
        'dropoff_location'     => 'Drop-off Location',
        'start_datetime'       => 'Start Date & Time',
        'end_datetime'         => 'End Date & Time',
        'total_price'          => 'Total Price',
        'total_price_helper'   => 'Automatically calculated when saved',
        'status'               => 'Status',

        // User
        'government_id'       => 'Government ID',
        'new_password'        => 'New Password',
        'new_password_in_form'=> 'New Password',
        'new_password_helper' => 'Leave blank to keep the current password.',
        'is_admin'            => 'Administrator',
        'is_admin_helper'     => 'Grants access to the admin panel.',

        // Video
        'video_path'           => 'Video File or URL',
        'thumbnail'            => 'Thumbnail',
        'is_active_slideshow'  => 'Active in Slideshow',
        'order'                => 'Display Order',

        // Form Select Options
        'options' => [
            'categories' => [
                'sedan'        => 'Sedan',
                'suv'          => 'SUV',
                'sports_car'   => 'Sports Car',
                'hatchback'    => 'Hatchback',
                'coupe'        => 'Coupe',
                'convertible'  => 'Convertible',
                'pickup_truck' => 'Pickup Truck',
                'van'          => 'Van',
            ],
            'fuel_types' => [
                'petrol'   => 'Petrol',
                'diesel'   => 'Diesel',
                'electric' => 'Electric',
                'hybrid'   => 'Hybrid',
            ],
            'transmissions' => [
                'manual'         => 'Manual',
                'automatic'      => 'Automatic',
                'semi-automatic' => 'Semi-Automatic',
            ],
            'status' => [
                'pending'   => 'Pending',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'canceled'  => 'Canceled',
                'overdue'   => 'Overdue',
            ],
        ],
    ],

    // Table Columns
    'table' => [
        // General
        'name'        => 'Name',
        'active'      => 'Active',
        'created_at'  => 'Created',
        'order'       => 'Order',

        // Car & Brand
        'brand'         => 'Brand',
        'brand_name'    => 'Brand Name',
        'logo'          => 'Logo',
        'quantity_short'=> 'Qty',
        'category'      => 'Category',
        'price_per_day' => 'Price/Day',
        'location'      => 'Location',
        'cars_count'    => 'Cars',

        // Gallery
        'image'    => 'Image',
        'alt_text' => 'Alt Text',

        // Location
        'google_maps' => 'Google Maps',
        
        // Reservation
        'user'        => 'User',
        'car'         => 'Car',
        'pickup'      => 'Pickup',
        'dropoff'     => 'Drop-off',
        'start'       => 'Start',
        'end'         => 'End',
        'total_price' => 'Total Price',
        'status'      => 'Status',

        // User
        'email'   => 'Email',
        'phone'   => 'Phone',
        'gov_id'  => 'Gov ID',
        'admin'   => 'Admin',

        // Video
        'preview'    => 'Preview',
        'title'      => 'Title',
        'video_path' => 'Video Path',
    ],

    // Table Filters
    'filters' => [
        'availability' => 'Availability Master Switch',
    ],

    // Table Actions
    'table_actions' => [
        'whatsapp'         => 'WhatsApp',
        'whatsapp_tooltip' => 'Message customer on WhatsApp',
        'reset_password'   => 'Reset Password',
    ],

    // Notifications
    'notifications' => [
        'password_reset_success' => 'Password reset successfully!',
    ],
];