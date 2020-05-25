@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    
<div class="row-fluid">
        <div class="span6">
            <div class="box box-color">
                <div class="box-title">
                    <h3><i class="icon-calendar"></i>My calendar</h3>
                </div>
                <div class="box-content nopadding">
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
  
					<div class="span6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-ok"></i> Tasks</h3>
								<div class="actions">
									<a href="#new-task" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Add Task</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<ul class="tasklist ui-sortable">
									<li class="bookmarked">
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-ok"></i><span>Approve new users</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<li>
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-bar-chart"></i><span>Check statistics</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<li class="done">
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-envelope"></i><span>Check for new mails</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<li>
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-comment"></i><span>Chat with John Doe</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<li>
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-retweet"></i><span>Go and tweet some stuff</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<li>
										<div class="check">
											<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
										</div>
										<span class="task"><i class="icon-edit"></i><span>Write an article</span></span>
										<span class="task-actions">
											<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task"><i class="icon-remove"></i></a>
											<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important"><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

    <div class="span6">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-user"></i>Address Book</h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content nopadding scrollable" data-height="300" data-visible="true">
                <table class="table table-user table-nohead">
                    <tbody>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>B</span>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
                            <td class='user'>Bi Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
                            <td class='user'>Boo Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>D</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-3.jpg" alt=""></td>
                            <td class='user'>Dan Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-4.jpg" alt=""></td>
                            <td class='user'>Dane Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>H</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-3.jpg" alt=""></td>
                            <td class='user'>Hilda N. Ervin</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>J</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-5.jpg" alt=""></td>
                            <td class='user'>John Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-6.jpg" alt=""></td>
                            <td class='user'>John Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>L</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-5.jpg" alt=""></td>
                            <td class='user'>Laura J. Brown</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-6.jpg" alt=""></td>
                            <td class='user'>Lilly J. Tooley</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>M</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
                            <td class='user'>Maxi Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
                            <td class='user'>Max Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>O</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
                            <td class='user'>Oxx Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
                            <td class='user'>Osam Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr class="alpha">
                            <td class="alpha-val">
                                <span>P</span>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
                            <td class='user'>Petra Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
                            <td class='user'>Per Doe</td>
                            <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection