@extends('backend.layouts.master')

@section('title')
    <title>Template</title>
@endsection

@section('content-head')
    <div class="profile-edit-page-header">
        <h2>Template</h2>
        <div class="breadcrumbs"><a href="#">Contoh</a><a href="#">Bread</a><span>Crumb</span></div>
    </div>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <h3>Indox</h3>
            </div>
            <!-- dashboard-list end-->    
            <div class="dashboard-list">
                <div class="dashboard-message">
                    <span class="new-dashboard-item">New</span>
                    <div class="dashboard-message-avatar">
                        <img src="{{ asset('theme') }}/images/avatar/1.jpg" alt="">
                    </div>
                    <div class="dashboard-message-text">
                        <h4>Andy Smith - <span>27 December 2018</span></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                        <span class="reply-mail clearfix">Reply : <a class="dashboard-message-user-mail" href="mailto:yourmail@domain.com" target="_top">yourmail@domain.com</a></span>	
                    </div>
                </div>
            </div>
            <!-- dashboard-list end-->    
            <!-- dashboard-list end-->    
            <div class="dashboard-list">
                <div class="dashboard-message">
                    <span class="new-dashboard-item">New</span>
                    <div class="dashboard-message-avatar">
                        <img src="{{ asset('theme') }}/images/avatar/avatar-bg.png" alt="">
                    </div>
                    <div class="dashboard-message-text">
                        <h4>Andy Smith - <span>27 December 2018</span></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                        <span class="reply-mail clearfix">Reply : <a class="dashboard-message-user-mail" href="mailto:yourmail@domain.com" target="_top">yourmail@domain.com</a></span>	
                    </div>
                </div>
            </div>
            <!-- dashboard-list end-->                                            
            <!-- dashboard-list end-->    
            <div class="dashboard-list">
                <div class="dashboard-message">
                    <div class="dashboard-message-avatar">
                        <img src="{{ asset('theme') }}/images/avatar/1.jpg" alt="">
                    </div>
                    <div class="dashboard-message-text">
                        <h4>Andy Smith - <span>27 December 2018</span></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                        <span class="reply-mail clearfix">Reply : <a class="dashboard-message-user-mail" href="mailto:yourmail@domain.com" target="_top">yourmail@domain.com</a></span>	
                    </div>
                </div>
            </div>
            <!-- dashboard-list end-->                                             
            <!-- dashboard-list end-->    
            <div class="dashboard-list">
                <div class="dashboard-message">
                    <div class="dashboard-message-avatar">
                        <img src="{{ asset('theme') }}/images/avatar/avatar-bg.png" alt="">
                    </div>
                    <div class="dashboard-message-text">
                        <h4>Andy Smith - <span>27 December 2018</span></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                        <span class="reply-mail clearfix">Reply : <a class="dashboard-message-user-mail" href="mailto:yourmail@domain.com" target="_top">yourmail@domain.com</a></span>	
                    </div>
                </div>
            </div>
            <!-- dashboard-list end-->                                            
            <!-- dashboard-list end-->    
            <div class="dashboard-list">
                <div class="dashboard-message">
                    <div class="dashboard-message-avatar">
                        <img src="{{ asset('theme') }}/images/avatar/1.jpg" alt="">
                    </div>
                    <div class="dashboard-message-text">
                        <h4>Andy Smith - <span>27 December 2018</span></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                        <span class="reply-mail clearfix">Reply : <a class="dashboard-message-user-mail" href="mailto:yourmail@domain.com" target="_top">yourmail@domain.com</a></span>	
                    </div>
                </div>
            </div>
            <!-- dashboard-list end--> 
        </div>
        <!-- pagination-->
        <div class="pagination">
            <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
            <a href="#">1</a>
            <a href="#" class="current-page">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
        </div>
    </div>
@endsection