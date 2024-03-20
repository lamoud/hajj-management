<?php
return [
    'base_route'      => 'admin/filemanager',
    'middleware'      => ['web', 'auth'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp,ico,svg,mp4,mpeg,wav,webm,ogg,pdf',//tinyAnyMceCallback
    'images_format'    => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico'],//tinyMceCallback
    'imgs_vds_format'    => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'mp4', 'mpeg', 'wav', 'webm', 'ogg'],//tinyImgsVdsMceCallback
    'videos_format'    => ['mp4', 'mpeg', 'wav', 'webm', 'ogg'],//tinyVideoMceCallback
    'pdfs_format'    => ['pdf'],//tinyPdfMceCallback
    'max_size'        => 50000,
    'max_image_width' => 1024,
    'image_quality'   => 80,
];