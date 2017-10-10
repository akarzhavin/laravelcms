<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>

<style>
    body{
        margin: 0
    }
    header{
        width:100%;
        height: 56px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 80;
        background-color: #fff;
        box-shadow: 2px 2px 5px 0 rgba(0,0,0,0.095);
        padding: 8px 16px;
        overflow: hidden;
        box-sizing: border-box;
    }
    header button{
        background: transparent;
        border: none;
        font-size: 30px  !important;
    }
    label{
        margin-bottom: 0;
        margin: 0 5px;
    }
    .el-submenu, .el-menu{
        background: #fff
    }
    .tac{
        margin-top: 60px;
        margin-right: 0 !important;
    }
    .wrapcontainer{
        transition: all 0.5s;
        margin-right: 20px;
    }
    .marContain-1{
        margin-left: 80px;
    }
    .marContain-2{
        margin-left: 220px;
    }
    .el-menu-vertical-demo{
        position: fixed;
        z-index: 999999;
        background: transparent;
        box-shadow: 2px 2px 5px 0 rgba(0,0,0,0.095);
        min-height: 100%;
    }
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
    }
    .button-addAll{
        position: absolute;
        right: 30px;
        top: 7px;
    }

    /*кнопка редактирования, добавления, в правом верхнем углу*/
    .ui-btn-save-div{
        width: 100%;
        margin-top: 20px;
        height: 40px;
    }
    .ui-btn-save{
        float: right;
    }
    .ui-btn-delete{
        float: right;
        margin-left: 10px;
        margin-top: 20px;
    }
    .btn-img-product-form{
        margin-left: 5px;
    }

    /* Producat_form  */

    /*add imgInput*/
    .img-product-form{
        position: relative;
    }
    .img-product-form img{
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
    .img-input{
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        opacity: 0;
    }

</style>

<div id="app">
    <header>
        <button @click='toggleMenu'><i class="fa fa-bars" aria-hidden="true"></i></button>
    </header>
    <div class="tac">
        <el-menu default-active="0" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse">
        <a href="/admin/categories" style="text-decoration: none">
            <el-menu-item index="1">
                <i class="el-icon-menu"></i>
                <span slot="title">Категории</span>
            </el-menu-item>
        </a>
        <a href="/admin/products" style="text-decoration: none">
            <el-menu-item index="2">
                <i class="el-icon-menu"></i>
                <span slot="title">Товары</span>
            </el-menu-item>
        </a>
        <a href="/admin/feature" style="text-decoration: none">
            <el-menu-item index="3">
                <i class="el-icon-setting"></i>
                <span slot="title">Характеристики</span>
            </el-menu-item>
        </a>
        <a href="/admin/filter" style="text-decoration: none">
            <el-menu-item index="4">
                <i class="el-icon-setting"></i>
                <span slot="title">Фильтры</span>
            </el-menu-item>
        </a>
        </el-menu>
    </div>