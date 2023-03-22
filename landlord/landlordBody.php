					
					<!-- ADMIN BODY STARTS HERE-------->
					<div class="row">
						<div class="col-md-12 col-md-offset-0">
											<div class="alert alert-success alert-dismissible col-lg-12 col-lg-offset-0 ">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
													<font color="green"><h5 align="center"><b>  Welcome <?php echo strtoupper($userNames); ?> , <?php echo $_SESSION['success']; ?> as <?php echo strtoupper($userRole); ?></b> </h5></font>
											</div>
											
						</div>
					</div>
								<!-- /.row -->
					
					<div class="row">
						<div class="col-md-12 col-md-offset-0">
							<fieldset> <legend>PAYMENTS </legend>
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-money fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php
															$sql = "SELECT * FROM payments where ownerID='$userID' ";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
													<div>ALL PAYMENTS</div>
												</div>
											</div>
										</div>
										<a href="view_payments.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										<a href="csv_exp_payments.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
									
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-green">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-money fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php

															$sql = "SELECT * FROM payments where ownerID='$userID' AND pay_status='received' ";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
												   <div>RECEIVED </div>
												</div>
											</div>
										</div>
										<a href="view_received_payments.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										 <a href="csv_exp_payments.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-red">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-money fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php

															$sql = "SELECT * FROM payments where ownerID='$userID' AND pay_status='denied' ";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
												   <div>DENIED</div>
												</div>
											</div>
										</div>
										<a href="view_rejected_payments.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										 <a href="csv_exp_bookings.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
									
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-money fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php
															$sql = "SELECT * FROM payments where ownerID='$userID' AND pay_status='pending' ";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
													<div>PENDING</div>
												</div>
											</div>
										</div>
										<a href="view_pending_payments.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										 <a href="csv_exp_invoices.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								</fieldset>
								<!-- /.col-lg-12 -------------------------------------------->
						</div>
					</div>
						<!-- ROW 1 ENDS HERE-->
					
					
					<!-- ROW 2 STARTS HERE-->
					<div class="row">
						<div class="col-md-12 col-md-offset-0">
							<fieldset> <legend>INVOICES </legend>
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-tasks fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
														<?php
															$sql = "SELECT *
															FROM invoice_items WHERE ownerID='$userID'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
													<div>ALL INVOICES</div>
												</div>
											</div>
										</div>
										<a href="view_invoices.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										<a href="csv_exp_tenants.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-green">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-tasks fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php
															$sql = "SELECT *
															FROM invoice_items WHERE ownerID='$userID' AND status='paid'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
													<div>FULLY PAID</div>
												</div>
											</div>
										</div>
										<a href="view_paid_invoices.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										 <a href="csv_exp_pending.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-tasks fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php
															
															$sql = "SELECT *
															FROM invoice_items WHERE ownerID='$userID' AND status='paid some'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
												   <div>PAID SOME</div>
												</div>
											</div>
										</div>
										<a href="view_paidsome_invoices.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										 <a href="csv_exp_payments.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-red">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-tasks fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php
															
															$sql = "SELECT *
															FROM invoice_items WHERE ownerID='$userID' AND status='not paid'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
												   <div>NOT PAID</div>
												</div>
											</div>
										</div>
										<a href="view_not_paid_invoices.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										 <a href="csv_exp_newpayments.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
							</fieldset>
								<!-- /.col-lg-12 -------------------------------------------->
						</div>
					</div>
						<!-- ROW 2 ENDS HERE-->
						
					<div class="row">
						<div class="col-md-12 col-md-offset-0">
							<fieldset> <legend>FARMS AND BLOCKS </legend>
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-home fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
														<?php      
															$sql = "SELECT *
															FROM farms where ownerID='$userID'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
													<div>FARMS</div>
												</div>
											</div>
										</div>
										<a href="view_farms.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										<a href="csv_exp_farms.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
									
								<div class="col-md-3 col-md-offset-0">
									<div class="panel panel-green">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-building fa-3x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">
															<?php 
															
															$sql = "SELECT *
															FROM blocks where ownerID='$userID'
															";
															$result = mysqli_query($db, $sql);
															$num_rows= mysqli_num_rows($result);
															if ($num_rows>0)
															{
															   echo $num_rows; 
															}

															else 
															{
																echo "0";
															}		
															 ?>
													</div>
												   <div>BLOCKS</div>
												</div>
											</div>
										</div>
										<a href="view_blocks.php">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
										
										<a href="csv_exp_blocks.php">
											<div class="panel-footer">
												<span class="pull-left">Export CSV</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
							
								
							</fieldset>
								<!-- /.col-lg-12 -------------------------------------------->
						</div>
					</div>
						
		<!-------------------------- ADMIN BODY ENDS HERE---------------------------------->