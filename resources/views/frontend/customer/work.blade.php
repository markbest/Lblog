@extends('_layouts.1column')
@section('title')
    作品 - mark-here.com
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="works-content">
            <div class="view">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-fw"></i> <a href="{{ url('/') }}">主页</a>
                    <li class="active">作品</li>
                </ul>
            </div>
            <ul class="works-list">
                <li>
                    <h1>Laravel</h1>
                    <div class="content">
                        <p><strong>1、Laravel_Blog: </strong>基于Laravel 5.1开发的轻量级的博客程序( <a target="_blank" href="https://github.com/markbest/laravel_blog">https://github.com/markbest/laravel_blog</a>)</p>
                        <p><strong>2、Laravel_Manage: </strong>基于Laravel 5.3开发的轻量级的文件管理系统( <a target="_blank" href="https://github.com/markbest/laravel_manage">https://github.com/markbest/laravel_manage</a>)</p>
                    </div>
                </li>
                <li>
                    <h1>PHP</h1>
                    <div class="content">
                        <p><strong>1、framework: </strong>自己学习写的一个PHP的MVC框架（正在完善中）( <a target="_blank" href="https://github.com/markbest/framework">https://github.com/markbest/framework</a>)</p>
                    </div>
                </li>
                <li>
                    <h1>博客文章</h1>
                    <div class="content">
                        <p>1、<a href="https://mark-here.com/article/50" title="Nginx日志过滤：使用ngx_log_if不记录特定日志">Nginx日志过滤：使用ngx_log_if不记录特定日志</a></p>
                        <p>2、<a href="https://mark-here.com/article/49" title="Sphinx Shell脚本">Sphinx Shell脚本</a></p>
                        <p>3、<a href="https://mark-here.com/article/48" title="nginx_concat_module部署实例">nginx_concat_module部署实例</a></p>
                        <p>4、<a href="https://mark-here.com/article/47" title="Magento添加Advanced Dataflow">Magento添加Advanced Dataflow</a></p>
                        <p>5、<a href="https://mark-here.com/article/45" title="Nginx服务器日志分割处理">Nginx服务器日志分割处理</a></p>
                        <p>6、<a href="https://mark-here.com/article/43" title="Magento Collection方法介绍">Magento Collection方法介绍</a></p>
                        <p>7、<a href="https://mark-here.com/article/40" title="处理大型的Magento集合">处理大型的Magento集合</a></p>
                        <p>8、<a href="https://mark-here.com/article/22" title="Magento事务处理使用方法">Magento事务处理使用方法</a></p>
                        <p>9、<a href="https://mark-here.com/article/15" title="Magento常用模块分享">Magento常用模块分享</a></p>
                        <p>10、<a href="https://mark-here.com/article/14" title="Magento实现下载csv数据表格">Magento实现下载csv数据表格</a></p>
                        <p>11、<a href="https://mark-here.com/article/13" title="Magento上传文件、缩略图和导出CSV">Magento上传文件、缩略图和导出CSV</a></p>
                        <p>12、<a href="https://mark-here.com/article/10" title="Magento给常用的Block添加缓存">Magento给常用的Block添加缓存</a></p>
                        <p>13、<a href="https://mark-here.com/article/9" title="Magento后台添加rule规则">Magento后台添加rule规则</a></p>
                        <p>14、<a href="https://mark-here.com/article/5" title="Magento开发常用函数">Magento开发常用函数</a></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection