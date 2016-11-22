<?php 
if(!isset($_GET['id']))
{
	echo "缺少参数,请勿直接访问本页面！";
	exit(0);
	
}
if(!isset($_GET['page']))
{
	$_GET['page'] = 1;
}
	
?>
<!-- Page Content -->        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Data Analysis</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
			<?php
			// load database
				$con = mysqli_connect("119.29.106.147","esdc","123456","ESDC");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}
				// some code
				$sql = "select * from task where t_id=\"".$_GET['id']."\";";
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_array($result);
				$a_id = $row['a_id'];
				$date = $row['t_date'];
				$start = $row['t_start_time'];
				$end   = $row['t_end_time'];
				// for row_data table
				$sql2  = "SELECT COUNT(*) FROM `raw_data` WHERE `a_id` = $a_id AND `date` = '$date' AND `time` BETWEEN '$start' AND '$end' ORDER BY `d_id` DESC";
				$result = mysqli_query($con,$sql2);
				$row = mysqli_fetch_array($result);
				$count = $row[0];
			?>
            <div class="row">
            	<div class="col-lg-12">
            		<div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>AIRCRAFT</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>POLL1</th>
                                                    <th>POLL2</th>
                                                    <th>POLL3</th>
                                                    <th>POLL4</th>
                                                    <th>POLL5</th>
                                                    <th>Photo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php
													$sql3  = "SELECT * FROM `raw_data` WHERE `a_id` = $a_id AND `date` = '$date' AND `time` BETWEEN '$start' AND '$end' ORDER BY `d_id` DESC LIMIT ".(20*($_GET['page'] - 1)).",20";
													$result = mysqli_query($con,$sql3);
													while($row = mysqli_fetch_array($result))
													{
														$html_code = "
														<tr>
															<td>".$row['a_id']."</td>
															<td>".$row['date']."</td>
															<td>".$row['time']."</td>
															<td>".$row['poll_1']."</td>
															<td>".$row['poll_2']."</td>
															<td>".$row['poll_3']."</td>
															<td>".$row['poll_4']."</td>
															<td>".$row['poll_5']."</td>
															<td>".$row['photo_id']."</td>
														</tr>
														";
														echo $html_code;
													}

												?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
            	</div>
            	<!-- /.col-lg-12-->
            </div>
            <!-- /.row -->
            <div class="row">
            	<div class="col-lg-2"></div>
					<div class="col-lg-1">
					<?php 
						if($_GET['page'] != 1)
						{
							$html_code = "
							<a href=\"./analyze2?id=".$_GET['id']."&page=".($_GET['page'] - 1)."\""."><button type=\"button\" class=\"btn btn-primary btn-sm\" ><< Lsat Page</button></a>
							";
							echo $html_code;
						}
					?>
						
					</div>
            	<div class="col-lg-2"></div>
					<div class="col-lg-1">
					<?php 
						if($count > 20)
						{
							$html_code = "
							<button type=\"button\" class=\"btn btn-default btn-sm\" >".$_GET['page']."/".((int)($count/20) + 1)."</button>
							
							";
							echo $html_code;
						}
					?>
					</div>
				<div class="col-lg-2"></div>
					<div class="col-lg-1">
					<?php 
						if($count > 20 && $_GET['page'] * 20 < $count)
						{
							$html_code = "
							<a href=\"./analyze2?id=".$_GET['id']."&page=".($_GET['page'] + 1)."\""."><button type=\"button\" class=\"btn btn-primary btn-sm\" >Next Page >></button></a>
							";
							echo $html_code;
						}
					?>
					</div>
					<div class="col-lg-3"></div>
            </div>

			
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    
    


</body>

</html>
