<?php 
/***
* Template Name: 晋级明细 
**/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<!-- page heading start-->
<div class="page-heading">
    <h3><?php the_title(); ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">控制面板</a>
        </li>
        <li class="active"><?php the_title(); ?></li>
    </ul>
</div>
<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    明细列表
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>金额</th>
                                    <th>备注</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                </tr>
                                <tr class="gradeC">
                                    <td>Trident</td>
                                    <td>InternetExplorer 5.0</td>
                                    <td>Win 95+</td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Trident</td>
                                    <td>InternetExplorer 5.5</td>
                                    <td>Win 95+</td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Trident</td>
                                    <td>InternetExplorer 6</td>
                                    <td>Win 98+</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>金额</th>
                                    <th>备注</th>
                                    <th>日期</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
<?php endwhile; else: ?>
<?php  endif; ?>
<?php rewind_posts(); ?>
<?php get_footer(); ?>


