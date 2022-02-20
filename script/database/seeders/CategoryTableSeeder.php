<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Domain;
use App\Option;
use App\Category;
use App\Categorymeta;
use App\Media;
use App\Categorymedia;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = array(
  array('id' => '1','name' => 'Default','slug' => 'default','type' => 'parent_attribute','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38','user_id' => '1'),
  array('id' => '2','name' => 'COD','slug' => 'cod','type' => 'payment_getway','p_id' => NULL,'featured' => '1','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38','user_id' => '1'),
  array('id' => '3','name' => 'INSTAMOJO','slug' => 'instamojo','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39','user_id' => '1'),
  array('id' => '4','name' => 'RAZORPAY','slug' => 'razorpay','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39','user_id' => '1'),
  array('id' => '5','name' => 'PAYPAL','slug' => 'paypal','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-29 09:12:16','user_id' => '1'),
  array('id' => '6','name' => 'STRIPE','slug' => 'stripe','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40','user_id' => '1'),
  array('id' => '7','name' => 'TOYYIBPAY','slug' => 'toyyibpay','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40','user_id' => '1'),
  array('id' => '8','name' => 'Mollie','slug' => 'mollie','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:54:58','updated_at' => '2020-12-14 06:28:00','user_id' => '1'),

  array('id' => '9','name' => 'Paystack','slug' => 'paystack','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:54:58','updated_at' => '2020-12-14 06:28:00','user_id' => '1'),

  array('id' => '10','name' => 'Mercado','slug' => 'mercado','type' => 'payment_getway','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '0','created_at' => '2020-12-12 14:54:58','updated_at' => '2020-12-14 06:28:00','user_id' => '1'),

  array('id' => '73','name' => 'James Curran','slug' => 'General Manager Spotify','type' => 'testimonial','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 17:36:54','updated_at' => '2020-12-18 17:36:54','user_id' => '1'),
  array('id' => '74','name' => 'Jose Evans','slug' => 'Chief Engineer Apple','type' => 'testimonial','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 17:37:34','updated_at' => '2020-12-18 17:37:34','user_id' => '1'),
  array('id' => '75','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:02:34','updated_at' => '2020-12-18 18:02:34','user_id' => '1'),
  array('id' => '76','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:02:43','updated_at' => '2020-12-18 18:02:43','user_id' => '1'),
  array('id' => '77','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:02:57','updated_at' => '2020-12-18 18:02:57','user_id' => '1'),
  array('id' => '78','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:03:05','updated_at' => '2020-12-18 18:03:05','user_id' => '1'),
  array('id' => '79','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:03:14','updated_at' => '2020-12-18 18:03:14','user_id' => '1'),
  array('id' => '81','name' => 'Start an online business','slug' => 'start-an-online-business','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57','user_id' => '1'),
  array('id' => '82','name' => 'Move your business online','slug' => 'move-your-business-online','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:23:50','updated_at' => '2021-01-09 17:23:50','user_id' => '1'),
  array('id' => '83','name' => 'Switch to salty','slug' => 'switch-to-salty','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:27:48','updated_at' => '2021-01-09 17:27:48','user_id' => '1'),
  array('id' => '85','name' => 'Hire a salty expert','slug' => 'hire-a-salty-expert','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:34:21','updated_at' => '2021-01-09 17:34:21','user_id' => '1'),
  array('id' => '87','name' => '#test','slug' => '','type' => 'gallery','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 18:19:05','updated_at' => '2021-01-09 18:19:05','user_id' => '1'),
  array('id' => '88','name' => '#','slug' => '1','type' => 'gallery','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 18:19:17','updated_at' => '2021-01-09 18:19:17','user_id' => '1'),
  array('id' => '89','name' => '#','slug' => '1','type' => 'gallery','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 18:19:27','updated_at' => '2021-01-09 18:19:27','user_id' => '1'),
  array('id' => '90','name' => '#','slug' => '1','type' => 'gallery','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 18:32:18','updated_at' => '2021-01-09 18:32:18','user_id' => '1'),
  array('id' => '91','name' => 'Product Inventors','slug' => 'start-an-online-business','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57','user_id' => '1'),
  array('id' => '92','name' => 'Easy to customization','slug' => 'start-an-online-business','type' => 'features','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57','user_id' => '1'),
  array('id' => '93','name' => '#','slug' => NULL,'type' => 'brand','p_id' => NULL,'featured' => '0','menu_status' => '0','is_admin' => '1','created_at' => '2020-12-18 18:03:14','updated_at' => '2020-12-18 18:03:14','user_id' => '1'),
  
);

    Category::insert($categories);


    $categorymetas = array(
  array('id' => '1','category_id' => '2','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38'),
  array('id' => '2','category_id' => '2','type' => 'preview','content' => 'uploads/cod.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '3','category_id' => '3','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '4','category_id' => '3','type' => 'preview','content' => 'uploads/instamojo.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '5','category_id' => '4','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '6','category_id' => '4','type' => 'preview','content' => 'uploads/razorpay.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '7','category_id' => '5','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '8','category_id' => '5','type' => 'preview','content' => 'uploads/paypal.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '9','category_id' => '6','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40'),
  array('id' => '10','category_id' => '6','type' => 'preview','content' => 'uploads/stripe.png','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40'),
  array('id' => '11','category_id' => '7','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40'),
  array('id' => '12','category_id' => '7','type' => 'preview','content' => 'uploads/toyyibpay.jpg','created_at' => '2020-12-12 14:49:40','updated_at' => '2020-12-12 14:49:40'),
  array('id' => '35','category_id' => '73','type' => 'excerpt','content' => 'We use Impact mainly for its site explorer, and it’s immensely improved how we find link targets. We use it both for getting quick analysis of a site, as well as utilizing its extensive index when we want to dive deep.','created_at' => '2020-12-18 17:36:54','updated_at' => '2020-12-18 17:36:54'),
  array('id' => '36','category_id' => '74','type' => 'excerpt','content' => 'We use Impact mainly for its site explorer, and it’s immensely improved how we find link targets. We use it both for getting quick analysis of a site, as well as utilizing its extensive index when we want to dive deep.','created_at' => '2020-12-18 17:37:34','updated_at' => '2020-12-18 17:37:34'),
  array('id' => '37','category_id' => '75','type' => 'preview','content' => 'uploads/1/2020/12/1608314554.png','created_at' => '2020-12-18 18:02:34','updated_at' => '2020-12-18 18:02:34'),
  array('id' => '38','category_id' => '76','type' => 'preview','content' => 'uploads/1/2020/12/1608314563.png','created_at' => '2020-12-18 18:02:43','updated_at' => '2020-12-18 18:02:43'),
  array('id' => '39','category_id' => '77','type' => 'preview','content' => 'uploads/1/2020/12/1608314577.png','created_at' => '2020-12-18 18:02:57','updated_at' => '2020-12-18 18:02:57'),
  array('id' => '40','category_id' => '78','type' => 'preview','content' => 'uploads/1/2020/12/1608314585.png','created_at' => '2020-12-18 18:03:06','updated_at' => '2020-12-18 18:03:06'),
  array('id' => '41','category_id' => '79','type' => 'preview','content' => 'uploads/1/2020/12/1608314594.png','created_at' => '2020-12-18 18:03:14','updated_at' => '2020-12-18 18:03:14'),
  array('id' => '42','category_id' => '8','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38'),
  array('id' => '43','category_id' => '8','type' => 'preview','content' => 'uploads/mollie.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '44','category_id' => '4','type' => 'credentials','content' => '{"key_id":"","key_secret":"","currency":"USD"}','created_at' => '2020-12-29 07:42:37','updated_at' => '2020-12-29 07:51:10'),
  array('id' => '45','category_id' => '3','type' => 'credentials','content' => '{"x_api_Key":"","x_api_token":""}','created_at' => '2020-12-29 07:42:54','updated_at' => '2020-12-29 07:42:54'),
  array('id' => '46','category_id' => '5','type' => 'credentials','content' => '{"client_id":"","client_secret":"","currency":"USD"}','created_at' => '2020-12-29 07:43:08','updated_at' => '2020-12-29 09:01:49'),
  array('id' => '47','category_id' => '6','type' => 'credentials','content' => '{"publishable_key":"","secret_key":"","currency":"USD"}','created_at' => '2020-12-29 07:43:20','updated_at' => '2020-12-29 07:50:41'),
  array('id' => '48','category_id' => '7','type' => 'credentials','content' => '{"userSecretKey":"","categoryCode":""}','created_at' => '2020-12-29 07:43:32','updated_at' => '2020-12-29 07:43:32'),
  array('id' => '49','category_id' => '8','type' => 'credentials','content' => '{"api_key":"","currency":"USD"}','created_at' => '2020-12-29 07:50:18','updated_at' => '2020-12-29 07:50:18'),
  array('id' => '50','category_id' => '81','type' => 'preview','content' => 'uploads/1/2021/01/1610212857.svg','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
  array('id' => '51','category_id' => '81','type' => 'excerpt','content' => 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
  array('id' => '52','category_id' => '82','type' => 'preview','content' => 'uploads/1/2021/01/1610213030.svg','created_at' => '2021-01-09 17:23:51','updated_at' => '2021-01-09 17:23:51'),
  array('id' => '53','category_id' => '82','type' => 'excerpt','content' => 'Turn your retail store into an online store and keep serving customers without missing a beat.','created_at' => '2021-01-09 17:23:51','updated_at' => '2021-01-09 17:23:51'),
  array('id' => '54','category_id' => '83','type' => 'preview','content' => 'uploads/1/2021/01/1610213268.svg','created_at' => '2021-01-09 17:27:48','updated_at' => '2021-01-09 17:27:48'),
  array('id' => '55','category_id' => '83','type' => 'excerpt','content' => 'Bring your business to Shopify, no matter which ecommerce platform you’re currently using.','created_at' => '2021-01-09 17:27:48','updated_at' => '2021-01-09 17:27:48'),
  array('id' => '58','category_id' => '85','type' => 'preview','content' => 'uploads/1/2021/01/1610213661.svg','created_at' => '2021-01-09 17:34:21','updated_at' => '2021-01-09 17:34:21'),
  array('id' => '59','category_id' => '85','type' => 'excerpt','content' => 'Get set up with the help of a trusted freelancer or agency from the dokans Experts Marketplace.','created_at' => '2021-01-09 17:34:21','updated_at' => '2021-01-09 17:34:21'),
  array('id' => '61','category_id' => '87','type' => 'preview','content' => 'uploads/admin/1/2021/01/1610216345.webp','created_at' => '2021-01-09 18:19:05','updated_at' => '2021-01-09 18:19:05'),
  array('id' => '62','category_id' => '88','type' => 'preview','content' => 'uploads/admin/1/2021/01/1610216357.webp','created_at' => '2021-01-09 18:19:17','updated_at' => '2021-01-09 18:19:17'),
  array('id' => '63','category_id' => '89','type' => 'preview','content' => 'uploads/admin/1/2021/01/1610216367.webp','created_at' => '2021-01-09 18:19:27','updated_at' => '2021-01-09 18:19:27'),
  array('id' => '64','category_id' => '90','type' => 'preview','content' => 'uploads/admin/1/2021/01/1610217138.webp','created_at' => '2021-01-09 18:32:18','updated_at' => '2021-01-09 18:32:18'),
  array('id' => '65','category_id' => '9','type' => 'credentials','content' => '{"public_key":"","secret_key":"","currency":"GHS"}','created_at' => '2020-12-29 07:50:18','updated_at' => '2020-12-29 07:50:18'),

  array('id' => '66','category_id' => '9','type' => 'preview','content' => 'uploads/paystack.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '67','category_id' => '9','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38'),
  array('id' => '68','category_id' => '91','type' => 'excerpt','content' => 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
  array('id' => '69','category_id' => '92','type' => 'excerpt','content' => 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
  
  array('id' => '70','category_id' => '91','type' => 'preview','content' => 'uploads/1/2021/01/1610212859.svg','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
  array('id' => '71','category_id' => '92','type' => 'preview','content' => 'uploads/1/2021/01/1610212858.svg','created_at' => '2021-01-09 17:20:57','updated_at' => '2021-01-09 17:20:57'),
   array('id' => '72','category_id' => '93','type' => 'preview','content' => 'uploads/1/2020/12/nginx-logo.svg','created_at' => '2020-12-18 18:03:14','updated_at' => '2020-12-18 18:03:14'),
    
    array('id' => '73','category_id' => '10','type' => 'credentials','content' => '{"public_key":"","access_token":""}','created_at' => '2020-12-29 07:50:18','updated_at' => '2020-12-29 07:50:18'),

  array('id' => '74','category_id' => '10','type' => 'preview','content' => 'uploads/mercado.png','created_at' => '2020-12-12 14:49:39','updated_at' => '2020-12-12 14:49:39'),
  array('id' => '75','category_id' => '10','type' => 'description','content' => 'description','created_at' => '2020-12-12 14:49:38','updated_at' => '2020-12-12 14:49:38'),

);

    Categorymeta::insert($categorymetas);

    }
}