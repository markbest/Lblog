# laravel_blog
基于laravel 5.1开发的轻量级的博客程序，Demo地址：https://mark-here.com

# 博客截图
![前台](https://mark-here.com/uploads/screen/frontend.jpg)
![后台](https://mark-here.com/uploads/screen/admin.jpg)

# 博客组件
- [yuanchao/laravel-5-markdown-editor](https://github.com/yccphp/laravel-5-markdown-editor)
- [hieu-le/active](https://github.com/letrunghieu/active)
- [spatie/laravel-pjax](https://github.com/spatie/laravel-pjax)
- [predis/predis](https://github.com/nrk/predis)

# 博客特色
- 简单的文章管理
- 简单的文章分类管理
- 前台客户注册以及客户中心管理
- 使用Redis管理博客的缓存
- 资料后台上传、前台下载

#安装使用
- 从[github](https://github.com/markbest/laravel_blog)上下载源代码
- 执行composer install
- 配置env数据库信息
- 安装数据库：php artisan migrate
- 填充测试数据：php artisan db:seed
- 博客后台登录地址：http://xxx/admin 用户名：admin@admin.com  密码：123456

